<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\ValidateUserRequest;

class UsersController extends Controller
{
    public function uniqueUser(ValidateUserRequest $request)
    {
        return response()->json(['success' => false]);
    }
}
