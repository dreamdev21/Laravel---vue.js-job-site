<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use App\TheBetaPlan\Payments\Gateway;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\Payment as PayPalPayment;
use PayPal\Api\RedirectUrls;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\PaymentReceivedRequest;
use App\Models\Status;

class PaymentsController extends Controller
{
    public function forAdmin()
    {
        if (!auth()->user()->isAdmin()) {
            return abort(403, 'you are not allowed to view this resource');
        }
        $payments = Payment::with(['invoice.entity', 'payer'])->latest()->paginate(request('perPage', 25));
        return PaymentResource::collection($payments);
    }

    public function index()
    {
        $payments = auth()->user()->payments()->with('invoice.entity')->latest()->get();
        return PaymentResource::collection($payments);
    }

    /**
     * Create a paypal payment for published project
     *
     * @return \Illuminate\Http\Response
     */
    public function store($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        if ($invoice->is_paid) {
            return abort(422, 'This invoice has already been paid');
        }
        if ($invoice->payment) {
            return new PaymentResource($invoice->payment);
        }
        if (request('gateway', 'paypal') === 'paypal') {
            return $this->payWithPaypal($invoice);
        }
    }

    public function invoicePaid(PaymentReceivedRequest $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        if ($invoice->payment->id !== $request->id) {
            return abort(422, 'invalid invoice id');
        }
        $payment = Payment::findOrFail($request->id);
        $paypalPayment = PayPalPayment::get($payment->transaction_id, Gateway::paypal());
        if ($paypalPayment->getState() !== 'approved') {
            return abort(422, "Payment hasn't been approved by payer.");
        }
        $payment->sell_id = $request->sell_id;
        $payment->paid_on = now();
        $payment->is_paid = true;
        $payment->paypal_payer_id = $request->paypal_payer_id;
        $payment->paypal_payer_email = $request->paypal_payer_email;
        $payment->payer_id = auth()->user()->id;
        $payment->save();
        $project = $payment->invoice->entity;
        $project->setStatus(Status::RUNNING);
        activity()
          ->inLog("publisher-project")
          ->causedBy(auth()->user())
          ->performedOn($project)
          ->log('Payment sent');
        return new PaymentResource($payment);
    }

    public function paypalConfig()
    {
        $data = config('paypal');
        unset($data['client_secret']);
        return response()->json($data);
    }

    protected function payWithPaypal(Invoice $invoice)
    {
        $apiContext = Gateway::paypal();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($invoice->total);
        $amount->setCurrency('USD');

        $item = new Item();
        $item->setName($invoice->entity->name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku($invoice->entity->name)
            ->setPrice($invoice->total);
        $itemList = new ItemList();
        $itemList->setItems(array($item));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment for project " . $invoice->entity->name)
            ->setInvoiceNumber($invoice->invoice_number);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(url('/'))
            ->setCancelUrl(url('/')); // doesn't really matter due to client side integration

        $paypalPayment = new PayPalPayment();
        $paypalPayment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        $paypalPayment->create($apiContext);
        $payment = new Payment();
        $payment->transaction_id = $paypalPayment->getId();
        $payment->total_amount = $invoice->total;
        $payment->gateway = 'paypal';
        $invoice->payments()->save($payment);
        return new PaymentResource($payment);
    }
}
