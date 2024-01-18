<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $data["type_menu"] = "product";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["dtProducts"] = \App\Models\ProductModel::paginate(8);
        // $data["dtProducts"] = DB::table("tbl_products")
        //     ->when($request->input("search"), function ($query, $condition) {
        //         return $query->where(
        //             "name",
        //             "like",
        //             "%" . $condition . "%"
        //         );
        //     })
        //     ->orderBy("id", "desc")
        //     ->paginate(8);
        //     dd($data);
        return view("product.index", $data);
    }

    public function create()
    {
        $data["type_menu"] = "product";
        return view("product.form", $data);
    }

    public function store(Request $request)
    {
        // dd($request->hasFile('pictureXX'));
        // dd($request);
        $request->validate([
            'name' => 'required|max:255|min:3|unique:tbl_products',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'picture'  => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // $postedData = $request->all();
        $postedData = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_available' => true,
        ];
        
        //--Picture:
        // $filename = time() . '.' . $request->picture->extension();
        // $request->picture->storeAs('public/uploads/product', $filename);
        //--OR--
        if($request->hasFile('picture')){
            $clientFileName = $request->file('picture')->getClientOriginalName();
            $fileName = pathinfo($clientFileName, PATHINFO_FILENAME);
            $fileExtension = pathinfo($clientFileName, PATHINFO_EXTENSION);
            $newFilename = time()."-".$fileName.".".$fileExtension;
            $request->picture->move(public_path('uploads/product'), $newFilename);
            //--update filename in DB:
            $postedData['picture'] = $newFilename;
        }
        // dd($postedData);

        $posted = ProductModel::create($postedData);

        if ($posted) {
            return redirect('product')->with('success', 'New data successfully saved');
        }else{
            return redirect()->back()->with('error', 'Error during saving data. Please contact Administrator.');
        }
    }

    public function edit($id)
    {
        $data["type_menu"] = "product";
        $data["dtProduct"] = ProductModel::findOrFail($id);
        return view("product.form", $data);
    }

    public function update(Request $request, $id)
    {
        $dtProduct = ProductModel::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255|min:3|unique:tbl_products',
            'description' => 'required',
            'category_id' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            // 'picture'  => 'required|image|mimes:png,jpg,jpeg'
        ]);

        // $postedData = $request->all();
        $postedData = [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        //--Picture:
        if($request->hasFile('picture')){
            $clientFileName = $request->file('picture')->getClientOriginalName();
            $fileName = pathinfo($clientFileName, PATHINFO_FILENAME);
            $fileExtension = pathinfo($clientFileName, PATHINFO_EXTENSION);
            $newFilename = time()."-".$fileName.".".$fileExtension;
            // $newFilename = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('uploads/product'), $newFilename);
            //--Delete Old File
            $oldFile = public_path('uploads/product/'.$dtProduct->picture);
            unlink($oldFile);
            //--update filename in DB:
            $postedData['picture'] = $newFilename;
        }else{
            unset($request->picture);
        }
        
        if ($dtProduct->update($postedData)) {
            return redirect('product')->with('success', 'Data successfully updated');
        }else{
            return redirect()->back()->with('error', 'Error during updating data. Please contact Administrator.');
        }
    }

    public function destroy($id)
    {
        $dtProduct = ProductModel::findOrFail($id);
        if ($dtProduct->delete()) {
            return redirect('product/index')->with('success', 'Data successfully deleted.');
        }else{
            return redirect()->back()->with('error', 'Error during deleting data. Please contact Administrator.');
        }    
    }

    function _uploadFile(Request $request, $id)
    {
        // die('uploadFile');
        $this->validate($request,[
            'picture' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $file_name = $request->file('picture')->getClientOriginalName();
        $fileName = pathinfo($file_name, PATHINFO_FILENAME);
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $newName = $fileName."-".$id.".".$extension;
        $request->picture->move(public_path('uploads/product'), $newName);

        $postedData = [
            'picture' => $newName
        ];

        $dtProduct = ProductModel::findOrFail($id);
        if ($dtProduct->update($postedData)) {
            return redirect()->back()->with('success', 'Image successfully uploaded');
        }else{
            return redirect()->back()->with('error', 'Error during uploading image. Please contact Administrator.');
        }
    }

    function _removeFile($id)
    {
        // die('removeFile');
        $dtProduct = ProductModel::findOrFail($id);
        $picture = $dtProduct->picture;
        $file_path = public_path().'/uploads/product/'.$picture;
        
        //--Delete file di DB:
        $updateData['picture'] = null;
        if ($dtProduct->update($updateData)) {
            //--Delete file di Path:
            // ($thisVar != $thatVar ?: doThis()); //--1 line IF without else
            // if ($thisVar == $thatVar) doThis();
            if(file_exists($file_path)) unlink($file_path);           
            return redirect()->back()->with('success', 'Image successfully removed');
        }else{
            return redirect()->back()->with('error', 'Error during removing image. Please contact Administrator.');
        }
    }
}
