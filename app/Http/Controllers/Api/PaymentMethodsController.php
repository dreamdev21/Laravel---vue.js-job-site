<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\PaymentMethod;

class PaymentMethodsController extends Controller
{
    public function index()
    {
        return PaymentMethodResource::collection(auth()->user()->paymentMethods);
    }

    public function store(PaymentMethodRequest $request)
    {
        $data = request()->all();
        $user = auth()->user();
        if ($data['gateway_type'] === 'paypal') {
            return $this->addPaypal($data['account_data'], $user);
        }
        return response()->json([]);
    }

    public function update($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        if ($paymentMethod->owner->id !== auth()->user()->id) {
            return abort(403, 'you are not allowed');
        }
        if (request('is_default')) {
            auth()->user()->paymentMethods()->where('id', '!=', $paymentMethod->id)
                ->update(['is_default' => false]);
            $paymentMethod->is_default = true;
            $paymentMethod->save();
            return new PaymentMethodResource($paymentMethod);
        }
        return response()->json([]);
    }

    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::findOrFail($id);
        if ($paymentMethod->owner->id !== auth()->user()->id) {
            return abort(403, 'you are not allowed');
        }
        if ($paymentMethod->is_default) {
            // make first another method as default
            auth()->user()->paymentMethods()
                ->where('id', '!=', $paymentMethod->id)
                ->limit(1)
                ->update(['is_default' => true]);
        }
        $paymentMethod->delete();
        return response()->json('', 204);
    }

    protected function addPaypal($data, $user)
    {
        // @TODO validate email of paypal before adding
        $paymentMethod = new PaymentMethod();
        $paymentMethod->account_data = $data;
        if ($user->paymentMethods->count() === 0) {
            $paymentMethod->is_default = true;
        }
        $user->paymentMethods()->save($paymentMethod);
        return new PaymentMethodResource($paymentMethod);
    }
}
