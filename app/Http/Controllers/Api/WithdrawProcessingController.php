<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\TheBetaPlan\Payments\Gateway;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;
use App\Models\WithdrawRequestTrack;

class WithdrawProcessingController extends Controller
{
    public function process()
    {
        $withdrawRequest = Withdrawal::findOrFail(request('withdrawal_id'));
        $receiver = $withdrawRequest->tester;
        $receiverAccountData = $receiver->default_paypal_email;
        if (!$receiverAccountData) {
            return abort(422, 'Tester does not have default paypal email selected');
        }
        $receiverEmail = $receiverAccountData['email'];
        $payout = new Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId($withdrawRequest->id)
            ->setEmailSubject("Your withdrawal request for $" . $withdrawRequest->amount . " has been processed");
        $amount = new Currency();
        $amount->setCurrency('USD');
        $amount->setValue($withdrawRequest->amount);
        $receiver = new PayoutItem();
        $receiver->setRecipientType('Email')
            ->setNote('Thanks you.')
            ->setReceiver($receiverEmail)
            ->setSenderItemId($withdrawRequest->id)
            ->setAmount($amount);
        $payout->setSenderBatchHeader($senderBatchHeader)
            ->addItem($receiver);
        try {
            $output = $payout->create(null, Gateway::paypal());
            $withdrawalTrack = new WithdrawRequestTrack();
            $withdrawalTrack->remote_identifier = $output->getBatchHeader()->getPayoutBatchId();
            $withdrawalTrack->withdrawal()->associate($withdrawRequest);
            $withdrawalTrack->save();
            $withdrawRequest->setStatus($output->getBatchHeader()->getBatchStatus());
        } catch (\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }
}
