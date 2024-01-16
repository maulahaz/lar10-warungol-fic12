<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $data["type_menu"] = "category";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["categories"] = DB::table("tbl_categories")
            ->when($request->input("search"), function ($query, $condition) {
                return $query->where(
                    "name",
                    "like",
                    "%" . $condition . "%"
                );
            })
            ->orderBy("id", "desc")
            ->paginate(10);
        return view("category.index", $data);
    }

    public function create()
    {
        $data["type_menu"] = "category";
        return view("category.form", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'picture'  => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);
        $data = $request->all();

        dd($data);
        CategoryModel::create($data);
        return redirect()
            ->route("category.index")
            ->with("success", "New data successfully saved");
    }

    public function edit($id)
    {
        $data["type_menu"] = "category";
        $data["dtCategory"] = CategoryModel::findOrFail($id);
        return view("category.form", $data);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'picture'  => 'required|max:255',
        ]);
        $data = CategoryModel::find($id);
        $data->update($request->all());
        return redirect()
            ->route("category.index")
            ->with("success", "Data successfully updated");
    }

    public function destroy($id)
    {
        DB::table("tbl_categories")
            ->where("id", $id)
            ->delete();
        return redirect()
            ->route("category.index")
            ->with("success", "Data successfully deleted");
    }
}
