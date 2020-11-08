<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Rules\isTipeObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    public function showAll(){
        $dataObat = Obat::all();
        $arrData = compact( 'dataObat');
        return $dataObat;
    }

    public function generateID(Request $request)
    {
        $nama = $request->nama;
        $inisial = strtoupper(substr($nama, 0, 2));

        $kode = Obat::select(DB::raw('LPAD(IFNULL(MAX(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newKode'))
            ->where('id', 'LIKE', "$inisial%")->get();

        $newKode = "OB".strtoupper($inisial) . $kode->first()->newKode;
        return $newKode;
    }


    public function create(Request $request)
    {

        if ($request->gambar) {
            $request->validate([
                'nama' => ['required', 'max:50'],
                'gambar' => ['file', 'image', 'mimes:png,jpg,jpeg', 'max:5048'],
                'harga' => ['required', 'numeric'],
                'indikasi' => ['required'],
                'stok' => ['required', 'numeric'],
                'satuan' => ['required'],
                'kemasan' => ['required'],
                'komposisi' => ['required'],
                'dosis' => ['required', 'max:100'],
                'segmentasi' => ['required'],
                'manufaktur' => ['required'],
            ]);
        } else {
            $validasi = $request->validate([
                'nama' => ['required', 'max:50'],
                'harga' => ['required', 'numeric'],
                'indikasi' => ['required'],
                'stok' => ['required', 'numeric'],
                'satuan' => ['required'],
                'kemasan' => ['required'],
                'komposisi' => ['required'],
                'dosis' => ['required', 'max:100'],
                'segmentasi' => ['required'],
                'manufaktur' => ['required'],
            ]);
        }

        return Obat::create($request->all());
    }




}
