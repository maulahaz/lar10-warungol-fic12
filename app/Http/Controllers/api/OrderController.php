<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateVAService;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'msg' => 'UnAuthorized',
            'data' => [],
        ]);
    }

    public function makeOrder(Request $request)
    {
        // dd($request->all());
        // return response()->json($request->all());
        $request->validate([
            'items' => 'required',
            'address_id' => 'required',
            'payment_method' => 'required',
            'shipping_service' => 'required',
            'shipping_cost' => 'required',
            // 'total_cost' => 'required',
        ]);

        $subTotal = 0;
        foreach ($request->items as $item) {
            //--Get Product Price:
            $product = \App\Models\ProductModel::find($item['product_id']);
            $subTotal += $product->price * $item['quantity'];
        }
        // return response()->json($subTotal);

        $orderPostData = [
            'user_id' => $request->user()->id,
            'transaction_number' => 'TRX-' . rand(100000, 999999),
            'status' => 'pending',
            'subtotal' => $subTotal,
            'payment_method' => $request->payment_method,
            'address_id' => $request->address_id,
            'shipping_service' => $request->shipping_service,
            'shipping_cost' => $request->shipping_cost,
            'total_cost' => $subTotal + $request->shipping_cost,
        ];


        //--If Payment by Bank (payment_va_name and payment_va_number is not null):
        //--Coz User can be use other Payment Method
        if ($request->payment_va_name) {
            $orderPostData['payment_va_name'] = $request->payment_va_name;
            $orderPostData['payment_type'] = $this->_getPaymentType($request->payment_va_name);
        }

        //--Create Order:
        $orderInserted = \App\Models\OrderModel::create($orderPostData);
        // return response()->json($orderInserted);

        $orderItemPostData = [];
        //--Create OrderItem:
        foreach ($request->items as $item) {
            $orderItemPostData['order_id'] = $orderInserted->id;
            $orderItemPostData['product_id'] = $item['product_id'];
            $orderItemPostData['quantity'] = $item['quantity'];

            \App\Models\OrderItemModel::create($orderItemPostData);
        }
        // $orderItemsInserted = \App\Models\OrderItemModel::create($orderItemPostData);

        //--Request ke Midtrans:
        $midtrans = new CreateVAService($orderInserted->load('user', 'orderItems'));
        $apiResponse = $midtrans->getVA();
        // return response()->json($apiResponse);

        $orderInserted->payment_va_number = $apiResponse->va_numbers[0]->va_number;
        $orderInserted->save();

        if ($orderInserted) {
            return response()->json([
                'status' => 'success',
                'msg' => 'success',
                'data' => $orderInserted,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Error during insert new data',
                'data' => [],
            ]);
        }
    }

    //--check Order Status:
    public function checkOrderStatus($id)
    {
        // return response()->json('test');
        $order = \App\Models\OrderModel::where('id', $id)->first();
        if ($order) {

            return response()->json([
                'status' => $order->status,
                'msg' => 'Data found'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'Data Not Found'
            ]);
        }
    }

    //--Get Order by Id:
    public function getOrderById(Request $request)
    {
        $order = \App\Models\OrderModel::where('id', $request->id)->first();
        return response()->json([
            'status' => 'success',
            'msg' => 'success',
            'data' => $order,
        ]);
    }

    //--Get Orders By UserId:
    public function getOrdersByUserId(Request $request)
    {
        $orders = \App\Models\OrderModel::where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'success',
            'data' => $orders,
        ]);
    }

    //--Payment method Alias:
    private function _getPaymentType($paymentVAName)
    {
        $paymentType = '';
        switch ($paymentVAName) {
            case 'bri':
                $paymentType = 'bank_transfer';
                break;
            case 'bca':
                $paymentType = 'bank_transfer';
                break;
            case 'bni':
                $paymentType = 'bank_transfer';
                break;
            case 'mandiri':
                $paymentType = 'echannel';
                break;
            case 'permata':
                $paymentType = 'permata';
                break;
            case 'qris':
                $paymentType = 'QRIS';
                break;
            case 'gopay':
                $paymentType = 'Gopay';
                break;
            default:
            $paymentType = 'bank_transfer';
                break;
        }

        return $paymentType;
    }

    // public function getOrderByIdx($id)
    // {
    //     $order = \App\Models\OrderModel::with('orderItems.product')->find('id');
    //     return response()->json([
    //         'status' => 'success',
    //         'msg' => 'success',
    //         'data' => $order,
    //     ]);
    // }
}
