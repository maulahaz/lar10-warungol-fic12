<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $condition = $request->input("search");

        $data["type_menu"] = "order";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["dtOrders"] = \App\Models\OrderModel::where('status', 'like', '%'.$condition.'%')
            ->orWhere('shipping_service', 'like', '%'.$condition.'%')
            // ->orWhereHas('type', function ($query) use ($key) {
            //     $query->where('status', 'like', $key.'%');
            // })
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

        $request->validate([
            'status' => 'required',
            'shipping_resi'  => 'required',
            'shipping_resi_picture'  => 'required|image|mimes:png,jpg,jpeg'
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
        $options = \App\Models\OptionModel::where('for','shipment_status')->get();
        foreach($options as $option){
            $data[$option->key] = $option->value;
        }
        return $data;
    }
}
