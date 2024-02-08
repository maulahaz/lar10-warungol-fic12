<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Midtrans\CallbackService;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    public function callbackOrder()
    {
        $callback = new CallbackService;
        $order = $callback->getOrder();
        if ($callback->isSuccess()) {
            $order->update([
                'status' => 'paid',
            ]);
        }elseif ($callback->isExpire()) {
            $order->update([
                'status' => 'expired',
            ]);
        }elseif ($callback->isCancelled()) {
            $order->update([
                'status' => 'cancelled',
            ]);
        }

        return response()->json(['message' => 'success'], 200);
    }
}
