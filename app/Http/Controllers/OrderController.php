<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
// use Illuminate\Notifications\Events\Notification;
// use Kreait\Laravel\Firebase\Facades\Firebase;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $condition = $request->input("search");

        $data["type_menu"] = "order";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["dtOrders"] = \App\Models\OrderModel::where('status', 'like', '%' . $condition . '%')
            ->orWhere('shipping_service', 'like', '%' . $condition . '%')
            // ->orWhereHas('type', function ($query) use ($key) {
            //     $query->where('status', 'like', $key.'%');
            // })
            ->orderBy('id', 'desc')
            ->paginate(8);
        return view("order.index", $data);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        return view('order.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data["type_menu"] = "order";
        $data["dtOrder"] = \App\Models\OrderModel::findOrFail($id);
        $data["optShipmentStatus"] = $this->_getShipmentOption();
        return view("order.form", $data);
    }

    public function update(Request $request, string $id)
    {
        $dtOrder = \App\Models\OrderModel::findOrFail($id);
        // dd($dtOrder->user_id);

        $request->validate([
            'status' => 'required',
            'shipping_resi'  => 'required',
            // 'shipping_resi_picture'  => 'required|image|mimes:png,jpg,jpeg'
        ]);

        // $postedData = $request->all();
        $postedData = [
            'status' => $request->status,
            'shipping_resi' => $request->shipping_resi,
            'notes' => $request->notes,
        ];

        //--Picture:
        if ($request->hasFile('shipping_resi_picture')) {
            $clientFileName = $request->file('shipping_resi_picture')->getClientOriginalName();
            $fileName = pathinfo($clientFileName, PATHINFO_FILENAME);
            $fileExtension = pathinfo($clientFileName, PATHINFO_EXTENSION);
            $newFilename = "Resi-" . $id . "-" . time() . "-" . $fileName . "." . $fileExtension;
            $request->shipping_resi_picture->move(public_path('uploads/order'), $newFilename);
            //--Delete Old File if any:
            if ($dtOrder->shipping_proof != null) {
                $oldFile = public_path('uploads/order/' . $dtOrder->shipping_proof);
                unlink($oldFile);
            }
            //--update filename in DB:
            $postedData['shipping_proof'] = $newFilename;
        } else {
            unset($request->shipping_resi_picture);
        }

        if ($dtOrder->update($postedData)) {

            //--Send Notification to User:
            if ($request->status == 'pending') {
                $this->sendNotificationToUser($dtOrder->user_id, 'Your order id #' . $id . " is pending. \nPlease complete the payment.");
            } else if ($request->status == 'paid') {
                $this->sendNotificationToUser($dtOrder->user_id, 'Your order id #' . $id . " is paid. \nPrepare for shipping.");
            } else if ($request->status == 'on_shipping') {
                $this->sendNotificationToUser($dtOrder->user_id, 'Your order id #' . $id . " is on the way. \nTracking ID: " . $request->shipping_resi);
            } else if ($request->status == 'shipped') {
                $this->sendNotificationToUser($dtOrder->user_id, 'Your order id #' . $id . " is delivered. \nPlease give us a feedback and rating.");
            } else if ($request->status == 'expired') {
                $this->sendNotificationToUser($dtOrder->user_id, 'Your order id #' . $id . " is expired. \nPlease shop again.");
            } else if ($request->status == 'cancelled') {
                $this->sendNotificationToUser($dtOrder->user_id, 'Your order id #' . $id . " is cancelled. \nPlease shop again.");
            }

            //--Redirect Page:
            return redirect('order')->with('success', 'Data successfully updated');
        } else {
            return redirect()->back()->with('error', 'Error during updating data. Please contact Administrator.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function _getShipmentOption()
    {
        $options = \App\Models\OptionModel::where('for', 'shipment_status')->get();
        foreach ($options as $option) {
            $data[$option->key] = $option->value;
        }
        return $data;
    }

    public function sendNotificationToUser($userId, $msg)
    {
        $user = \App\Models\User::find($userId);
        $token = $user->fcm_id;
        // dd($token);

        $messaging = app('firebase.messaging');
        $appName = config('myapp.APP_TITLE'); //MyApp::APP_TITLE;
        $notification = Notification::create($appName .' Order Status', $msg);

        $msg = CloudMessage::withTarget('token', $token)
            ->withNotification($notification);

        $messaging->send($msg);
    }
}
