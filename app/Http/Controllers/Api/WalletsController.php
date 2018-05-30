<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Http\Resources\WalletResource;

class WalletsController extends Controller
{
    public function index()
    {
        if (auth()->user()->wallet) {
            $wallet = auth()->user()->wallet;
        } else {
            $wallet = new Wallet();
        }
        return new WalletResource($wallet);
    }
}
