<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $data["type_menu"] = "product";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["dtProducts"] = DB::table("tbl_products")
            ->when($request->input("search"), function ($query, $condition) {
                return $query->where(
                    "name",
                    "like",
                    "%" . $condition . "%"
                );
            })
            ->orderBy("id", "desc")
            ->paginate(10);
        return view("product.index", $data);
    }

    public function create()
    {
        $data["type_menu"] = "product";
        return view("product.form", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'picture'  => 'required|max:255',
        ]);
        $data = $request->all();
        ProductModel::create($data);
        return redirect()
            ->route("product.index")
            ->with("success", "New data successfully saved");
    }

    public function edit($id)
    {
        $data["type_menu"] = "product";
        $data["dtProduct"] = ProductModel::findOrFail($id);
        return view("product.form", $data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'picture'  => 'required|max:255',
        ]);
        $data = ProductModel::find($id);
        $data->update($request->all());
        return redirect()
            ->route("product.index")
            ->with("success", "Data successfully updated");
    }

    public function destroy($id)
    {
        DB::table("tbl_products")
            ->where("id", $id)
            ->delete();
        return redirect()
            ->route("product.index")
            ->with("success", "Data successfully deleted");
    }
}
