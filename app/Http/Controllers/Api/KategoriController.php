<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\User;
use App\Rules\isPicture;
use App\Rules\isTooBig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function showAll()
    {
        $user = User::all();
        $all_kategori = Kategori::all();
        $arrData = compact('user', 'all_kategori');
        return $arrData;
    }

    public function addKategori(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'min:2'],
            'gambar' => [new isPicture, new isTooBig],
            'slug' => ['required', 'min:3'],
        ], [
            'nama.required' => ':attribute kategori harus diisi',
            'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
            'slug.required' => 'url kategori harus diisi',
            'slug.min' => 'Karakter harus lebih panjang dari 2 huruf',
        ]);


        return Kategori::create($request->all());
    }

    public function generateID(Request $request)
    {
        $nama = $request->nama;
        $inisial = strtoupper(substr($nama, 0, 2));

        $kode = Kategori::select(DB::raw('LPAD(IFNULL(MAX(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newKode'))
            ->where('id', 'LIKE', "$inisial%")->get();

        $newKode = strtoupper($inisial) . $kode->first()->newKode;
        return $newKode;
    }
}
