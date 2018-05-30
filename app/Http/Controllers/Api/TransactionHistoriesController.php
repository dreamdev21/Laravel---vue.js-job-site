<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Http\Resources\WalletResource;
use App\Http\Resources\TesterEarningResource;
use App\Http\Resources\WithdrawalResource;
use App\Models\Withdrawal;
use App\Models\TesterEarning;

class TransactionHistoriesController extends Controller
{
    public function forAdminPendingWithdrawal()
    {
        $withdrawal = Withdrawal::where('is_paid', false)->with(['tester', 'statuses'])->paginate(request('perPage', 25));
        return WithdrawalResource::collection($withdrawal);
    }

    public function forAdmin()
    {
        if (!auth()->user()->isAdmin()) {
            return abort(403, 'you are not allowed to view this resource');
        }
        $transactions = Withdrawal::select([
            'id', 'amount', 'balance_after', 'created_at', 'note', 'is_paid'
        ])->where('is_paid', true)->unionAll(TesterEarning::select([
            'id', 'amount', 'balance_after', 'created_at', 'note', 'is_bonus'
        ]))->latest();
        $pageNumber = request('page', 1);
        $pageLength = request('perPage', 25);
        $totalRecords = Withdrawal::where('is_paid', true)->count() + TesterEarning::count();
        $transactions = $transactions->limit($pageLength)->skip(($pageNumber - 1) * $pageLength)->get();
        $data = TesterEarningResource::collection($transactions)->toArray(request());
        return response()->json(['data' => $data, 'total' => $totalRecords]);
    }

    public function index()
    {
        $transactions = auth()->user()->withdrawals()->select([
            'id', 'amount', 'balance_after', 'created_at', 'note'
        ])->unionAll(auth()->user()->earnings()->select([
            'id', 'amount', 'balance_after', 'created_at', 'note'
        ]))->latest()->get();
        return TesterEarningResource::collection($transactions);
    }

    public function pendingWithdrawal()
    {
        $withdrawal = auth()->user()->withdrawals()->where('is_paid', false)->with('statuses')->get();
        if ($withdrawal) {
            return WithdrawalResource::collection($withdrawal);
        }
        return response()->json(null);
    }
}
