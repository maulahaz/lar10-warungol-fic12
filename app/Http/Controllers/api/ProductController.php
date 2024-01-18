<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        // $data = \App\Models\ProductModel::when($request->id, function($query, $id){
        //     return $query->where('id', $id);
        // })->get();

        //--Get Products by categoryId:
        $data = \App\Models\ProductModel::when($request->categoryId, function($query) use ($request){
            return $query->where('category_id', $request->categoryId);
        })->paginate(8);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        //
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
