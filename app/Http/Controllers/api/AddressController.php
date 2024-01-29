<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{

    public function index(Request $request)
    {
        $data = \App\Models\AddressModel::where('user_id', $request->user()->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function addressByUser(Request $request)
    {
        $data = DB::table('tbl_addresses')->where('user_id', $request->user()->id)->get();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'address' => 'required|string',
        //     'phone' => 'required|string',
        //     'province_id' => 'required|string',
        //     'city_id' => 'required|string',
        //     'district_id' => 'required|string',
        //     'postal_code' => 'required|string',
        //     'user_id' => 'required|integer',
        //     'is_default' => 'required|in:0,1',
            
        // ]);
        $postedData = [
            'name' =>$request->name,
            'address' =>$request->address,
            'phone' =>$request->phone,
            'province_id' =>$request->province_id,
            'city_id' =>$request->city_id,
            'district_id' =>$request->district_id,
            'postal_code' =>$request->postal_code,
            'user_id' =>$request->user()->id,
            'is_default' =>$request->is_default,
        ];
        // $data = $request->all();
        $inserted = \App\Models\AddressModel::insert($postedData);
        if($inserted) {
            return response()->json([
                'status' => 'success',
                'msg' => 'success',
                'data' => $postedData,
            ]);
        }else{
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
