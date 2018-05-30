<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WithdrawRequestTrack;
use App\TheBetaPlan\Payments\Gateway;
use PayPal\Api\Payout;
use App\Models\Payment;

class ProcessPaypalBatchStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'paypal:process_batch_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will process all the paypal payout batch to track its latest status';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $withRequestTracks = WithdrawRequestTrack::where('gateway_type', 'paypal')
            ->whereHas('withdrawal', function ($q) {
                $q->where('is_paid', false);
            })->get();
        $withRequestTracks->each(function ($r) {
            $this->processStatus($r);
        });
    }

    protected function processStatus($withdrawTrack)
    {
        $payoutBatch = Payout::get($withdrawTrack->remote_identifier, Gateway::paypal());
        $withdrwal = $withdrawTrack->withdrawal;
        $transactionItem = $payoutBatch->getItems()[0];
        $status = $transactionItem->getTransactionStatus();
        // $batchStatus = $payoutBatch->getItems();
        if ($status === 'SUCCESS') {
            $withdrwal->is_paid = true;
            $withdrwal->save();
            $this->createInvoiceAndPayment($transactionItem, $withdrwal);
        }
        $withdrwal->setStatus($status);
    }

    protected function createInvoiceAndPayment($transactionItem, $withdrwal)
    {
        $trasancationId = $transactionItem->getTransactionId();
        $invoice = $withdrwal->invoice;
        $payment = new Payment();
        $payment->transaction_id = $trasancationId;
        $payment->total_amount = $invoice->total;
        $payment->gateway = 'paypal';
        $payment->is_paid = true;
        $payment->payer_id = 1; // 1 is for admin
        $payment->paid_on = now();
        $payment->paypal_payer_email = 'System';
        $payment->paypal_payer_id = 'System';
        $payment->receiver_id = $withdrwal->tester->id;
        $payment->sell_id = $withdrwal->id;
        $invoice->payments()->save($payment);
    }
}
