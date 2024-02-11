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

    public function order(Request $request)
    {
        // dd($request->all());
        // return response()->json($request->all());
        $request->validate([
            'items' => 'required',
            'total_cost' => 'required',
            'address_id' => 'required',
            'payment_method' => 'required',
            'shipping_service' => 'required',
            'shipping_cost' => 'required',
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
        
        // return response()->json($orderPostData);
        //--If Payment by Bank (payment_va_name and payment_va_number is not null):
        //--Coz User can be use other Payment Method
        if($request->payment_va_name){
            $orderPostData['payment_va_name'] = $request->payment_va_name;
        }        
        
        //--Create Order:
        $orderInserted = \App\Models\OrderModel::create($orderPostData);
        // return response()->json($orderInserted);
        
        $orderItemPostData = [];
        //--Create OrderItem:
        foreach($request->items as $item){
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

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
