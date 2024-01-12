<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\UjianSoalList;
use App\Http\Resources\SoalResource;

class UjianController extends Controller
{

    public function create(Request $request)
    {
        //--get 20 soal angka random unique
        $soalArea1 = Soal::where('kategori', 'Area-1')->inRandomOrder()->limit(5)->get();
        $soalArea2 = Soal::where('kategori', 'Area-2')->inRandomOrder()->limit(5)->get();
        $soalArea3 = Soal::where('kategori', 'Area-3')->inRandomOrder()->limit(5)->get();
        $soalArea9 = Soal::where('kategori', 'Area-9')->inRandomOrder()->limit(5)->get();
        // return response()->json($soalArea9);

        $ujian = Ujian::create([
            'user_id' => $request->user()->id
        ]);

        foreach ($soalArea1 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        foreach ($soalArea2 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        foreach ($soalArea3 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        foreach ($soalArea9 as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        return response()->json([
            'message'   => 'Ujian berhasil dibuat',
            'data'      => $ujian
        ]);
    }

    public function createExamByCategory(Request $request)
    {
        $category = $request->category;
        // return response()->json($category);
        switch ($category) {
          case 'Area-1':
            $soalArea = Soal::where('kategori', 'Area-1')->inRandomOrder()->limit(5)->get();
            break;
          case 'Area-2':
            $soalArea = Soal::where('kategori', 'Area-2')->inRandomOrder()->limit(5)->get();
            break;
          case 'Area-3':
            $soalArea = Soal::where('kategori', 'Area-3')->inRandomOrder()->limit(5)->get();
            break;
          case 'Area-9':
            $soalArea = Soal::where('kategori', 'Area-9')->inRandomOrder()->limit(5)->get();
            break;
        }
        // return response()->json($soalArea);

        $ujian = Ujian::create([
            'user_id' => $request->user()->id,
            'kategori' => $category,
            'timer' => 15 //--Timer 15seconds
        ]);

        foreach ($soalArea as $row) {
            UjianSoalList::create([
                'ujian_id'  => $ujian->id,
                'soal_id'   => $row->id,
            ]);
        }

        return response()->json([
            'message'   => 'Exam '.$category.' created successfully',
            'data'      => $ujian
        ]);
    }

    public function getSoalUjianByKategori(Request $request)
    {
        //--Get Something by Category:
        if($request->kategori == 'Area-1'){
            $category_field = 'nilai_area1';
            $status_field = 'status_area1';
            $timer_field = 'timer_area1';
        }else if($request->kategori == 'Area-2'){
            $category_field = 'nilai_area2';
            $status_field = 'status_area2';
            $timer_field = 'timer_area2';
        }else if($request->kategori == 'Area-3'){
            $category_field = 'nilai_area3';
            $status_field = 'status_area3';
            $timer_field = 'timer_area3';
        }else if($request->kategori == 'Area-9'){
            $category_field = 'nilai_area9';
            $status_field = 'status_area9';
            $timer_field = 'timer_area9';
        }

        $ujian = Ujian::where('user_id', $request->user()->id)
            ->where($status_field, '!=', 'done')
            ->first();
        // return response()->json($ujian);
        //--if $ujian By User empty (All are done),then return empty:
        if(!$ujian){
            return response()->json([
                'message' => 'Failed : Ujian Not found',
                'data' => [],
            ]);
        }

        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->get();

        $soalId = $ujianSoalList->pluck('soal_id');

        $ujianSoalListId = [];
        foreach ($ujianSoalList as $row) {
            array_push($ujianSoalListId, $row->soal_id);
        }

        $soal = Soal::whereIn('id', $ujianSoalListId)->where('kategori', $request->kategori)->get();

        //--Get Something by Category:
        if($request->kategori == 'Area-1'){
            $timer = $ujian->timer_area1;
        }else if($request->kategori == 'Area-2'){
            $timer = $ujian->timer_area2;
        }else if($request->kategori == 'Area-3'){
            $timer = $ujian->timer_area3;
        }else if($request->kategori == 'Area-9'){
            $timer = $ujian->timer_area9;
        }

        return response()->json([
            'message'   => 'Berhasil',
            'timer'     => $timer,
            'data'      => SoalResource::collection($soal)
        ]);
    }

    public function getExamQuestionByKategori(Request $request)
    {
        $ujian = Ujian::where('user_id', $request->user()->id)
            ->where('kategori', $request->kategori)
            ->where('status', '!=', 'done')
            ->first();

        // return response()->json($ujian);
        //--if $ujian By User empty (All are done),then return empty:
        if(!$ujian){
            return response()->json([
                'message' => 'Failed : Exam Not found',
                'data' => [],
            ]);
        }

        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->get();

        $soalId = $ujianSoalList->pluck('soal_id');

        $ujianSoalListId = [];
        foreach ($ujianSoalList as $row) {
            array_push($ujianSoalListId, $row->soal_id);
        }

        $soal = Soal::whereIn('id', $ujianSoalListId)->where('kategori', $request->kategori)->get();

        return response()->json([
            'message'   => 'Berhasil',
            'timer'     => $ujian->timer,
            'data'      => SoalResource::collection($soal)
        ]);
    }

    public function jawabSoalUjian(Request $request)
    {
        //-- Attention to 'category' and 'kategori'

        $validatedData = $request->validate([
            'soal_id' => 'required',
            'jawaban' => 'required',
            'category' => 'required',
        ]);

        if($request->category == 'Area-1'){
            $category_field = 'nilai_area1';
            $status_field = 'status_area1';
            $timer_field = 'timer_area1';
        }else if($request->category == 'Area-2'){
            $category_field = 'nilai_area2';
            $status_field = 'status_area2';
            $timer_field = 'timer_area2';
        }else if($request->category == 'Area-3'){
            $category_field = 'nilai_area3';
            $status_field = 'status_area3';
            $timer_field = 'timer_area3';
        }else if($request->category == 'Area-9'){
            $category_field = 'nilai_area9';
            $status_field = 'status_area9';
            $timer_field = 'timer_area9';
        }

        $ujian = Ujian::where('user_id', $request->user()->id)
            ->where('kategori', $request->category)
            ->where('status', '!=', 'done')
            ->first();

        // $ujian = Ujian::where('user_id', $request->user()->id)
        //     // ->where('kategori', $request->kategori)
        //     ->where($status_field, '!=', 'done')
        //     ->first();
        // $ujian = Ujian::where('user_id', $request->user()->id)->first();
        // return response()->json($ujian);

        //--if $ujian empty, return empty:
        if(!$ujian){
            return response()->json([
                'message' => 'Failed : Ujian Not found',
                'data' => [],
            ]);
        }

        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)
                        ->where('soal_id', $validatedData['soal_id'])
                        ->first();

        $soal = Soal::where('id', $validatedData['soal_id'])->first();

        if($soal->jawaban == $validatedData['jawaban']){
            $postedData['kebenaran'] = true;
            $ujianSoalList->update($postedData);
        }else{
            $postedData['kebenaran'] = false;
            $ujianSoalList->update($postedData);
        }
        // return response()->json($ujianSoalList);
        

        return response()->json([
            'message' => 'Berhasil : Jawaban tersimpan',
            'jawaban' => $postedData,
        ]);

    }

    public function getExamResultByKategori(Request $request)
    {
        $category = $request->category;

        $ujian = Ujian::where('user_id', $request->user()->id)
                ->where('kategori', $category)
                ->where('status', '!=', 'done')
                ->first();

        if (!$ujian) {
            return response()->json([
                'message' => 'Failed : Ujian Not found',
                'data' => [],
            ]);
        }

        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->get();
        //--ujiansoallist by kategori
        $ujianSoalList = $ujianSoalList->filter(function ($value, $key) use ($category) {
            return $value->soal->kategori == $category;
        });

        //--Count Result
        $totalCorrect = $ujianSoalList->where('kebenaran', true)->count();
        $totalSoal = $ujianSoalList->count();
        if($totalSoal < 1){
            return response()->json([
                'message' => 'Fail : Total Question not available',
            ]);
        }

        $result = ($totalCorrect / $totalSoal) * 100;
        $hasil = $result >= 80 ? 'Passed' : 'Not Passed';
        // return response()->json($hasil);

        //--Get Timer by Category:
        if($category == 'Area-1'){
            $category_field = 'nilai_area1';
            $status_field = 'status_area1';
            $timer_field = 'timer_area1';
        }else if($category == 'Area-2'){
            $category_field = 'nilai_area2';
            $status_field = 'status_area2';
            $timer_field = 'timer_area2';
        }else if($category == 'Area-3'){
            $category_field = 'nilai_area3';
            $status_field = 'status_area3';
            $timer_field = 'timer_area3';
        }else if($category == 'Area-9'){
            $category_field = 'nilai_area9';
            $status_field = 'status_area9';
            $timer_field = 'timer_area9';
        }

        $ujian->update([
            $category_field => $result,
            $status_field => 'done',
            $timer_field => 0,
            'status' => 'done',
            'timer' => 0,
            'score' => $result,
            'hasil' => $hasil,
        ]);

        return response()->json([
            'message' => 'Berhasil : Exam result updated',
            'Result' => $result,
        ]);
    }

    public function getExamResult(Request $request)
    {
        // $ujian = Ujian::where('user_id', $request->user()->id)
        //         ->where('status', 'done')
        //         ->orderBy('id', 'desc')->take(5)
        //         ->get();

        // return response()->json($ujian); 

        $ujian = DB::table('tbl_ujian')
                  ->join('tbl_ujian_soal', 'tbl_ujian_soal.ujian_id', '=', 'tbl_ujian.id')
                  ->selectRaw(
                        '
                            tbl_ujian.*, 
                            COUNT(tbl_ujian_soal.ujian_id) as total_soal, 
                            SUM(tbl_ujian_soal.kebenaran) as total_correct
                        '
                    )
                  ->groupBy('tbl_ujian_soal.ujian_id')
                  ->orderBy('tbl_ujian.id', 'desc')
                  //->skip(1) //--Skip 1st row
                  ->take(6) //--Take 5rows after 1st row
                  ->get();                   

        if (!$ujian) {
            return response()->json([
                'status'    => 'fail',
                'message'   => 'Exam result Not found',
                'data'      => [],
            ]);
        }else{
            return response()->json([
                'status'    => 'success',
                'data'      => $ujian,
            ]);            
        }
    }
}
