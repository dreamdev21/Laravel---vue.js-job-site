<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Http\Resources\WithdrawalResource;
use App\Http\Requests\WithdrawalRequest;
use DB;
use Exception;
use App\Models\Status;

class WithdrawalsController extends Controller
{
    public function store(WithdrawalRequest $request)
    {
        $tester = auth()->user();
        if ($tester->withdrawals()->where('is_paid', false)->first()) {
            return abort(422, 'Withdrawal request is already pending.');
        }
        DB::beginTransaction();
        try {
            $withdrawal = new Withdrawal();
            $withdrawal->amount = $request->amount;
            $withdrawal->note = 'Withdrawal of $' . $request->amount;
            $withdrawal->tester()->associate($tester);
            $tester->wallet->deduct($request->amount);
            $withdrawal->balance_after = $tester->wallet->getBalance();
            $withdrawal->save();
            $withdrawal->createInvoice();
            $withdrawal->setStatus(Status::WITHDRAWAL_SUBMITTED);
            DB::commit();
            return new WithdrawalResource($withdrawal);
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
