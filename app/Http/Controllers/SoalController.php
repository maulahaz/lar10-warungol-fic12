<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSoalRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Soal;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        $data["type_menu"] = "soal";
        $data["isFiltered"] = (!is_null($request->input("search"))) ? true : false;
        $data["soals"] = DB::table("tbl_banksoal")
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

    public function index1()
    {
        $data["type_menu"] = "soal";
        return view("soal.index", $data);
    }

    public function list()
    {
        $data["type_menu"] = "soal";
        return view("soal.list", $data);
    }

    public function create()
    {
        $data["type_menu"] = "soal";
        return view("soal.form", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan'    => 'required|max:255',
            'kategori'      => 'required|in:Numeric,Verbal,Logika',
            'opsi_a'        => 'required|max:255',
            'opsi_b'        => 'required|max:255',
            'opsi_c'        => 'required|max:255',
            'opsi_d'        => 'required|max:255',
            'jawaban'       => 'required|in:a,b,c,d',
        ]);
        $data = $request->all();
        Soal::create($data);
        return redirect()
            ->route("soal.index")
            ->with("success", "Data successfully created");
    }

    public function edit($id)
    {
        $data["type_menu"] = "soal";
        $data["soal"] = Soal::findOrFail($id);
        return view("soal.form", $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan'    => 'required|max:255',
            'kategori'      => 'required|in:Numeric,Verbal,Logika',
            'opsi_a'        => 'required|max:255',
            'opsi_b'        => 'required|max:255',
            'opsi_c'        => 'required|max:255',
            'opsi_d'        => 'required|max:255',
            'jawaban'       => 'required|in:a,b,c,d',
        ]);
        $data = Soal::find($id);
        $data->update($request->all());
        return redirect()
            ->route("soal.index")
            ->with("success", "Data successfully updated");
    }

    public function destroy($id)
    {
        // dd('Data -'.$id);
        // $soal = DB::table('tbl_banksoal')->where('id', $id)->delete();
        // DB::delete('delete from tbl_banksoal where id = ?',[$id]);
        DB::table("tbl_banksoal")
            ->where("id", $id)
            ->delete();
        return redirect()
            ->route("soal.index")
            ->with("success", "Data successfully deleted");
        // return redirect()->back()->withErrors('Data successfully deleted');
        // if($soal){
        //     // dd('ok -'.$soal);
        // }else{
        //     // dd('not ok -'.$soal);
        //     return redirect()->back()->withErrors('Data successfully deleted');
        // }
    }
}
