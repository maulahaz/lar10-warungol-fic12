<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data["type_menu"] = "soal";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["soals"] = DB::table("tbl_categories")
            ->when($request->input("search"), function ($query, $condition) {
                return $query->where(
                    "pertanyaan",
                    "like",
                    "%" . $condition . "%"
                );
            })
            ->orderBy("id", "desc")
            ->paginate(10);
        return view("soal.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryModel $categoryModel)
    {
        //
    }
}
