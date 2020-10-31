<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Rules\isTipeObat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function create(Request $request)
    {

        if ($request->gambar) {
            $request->validate([
                'nama' => ['required', 'max:50'],
                'gambar' => ['file', 'image', 'mimes:png,jpg,jpeg', 'max:5048'],
                'tipe_obat' => ['required', new isTipeObat()],
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
            // DD($request->all());
            $validasi = $request->validate([
                'nama' => ['required', 'max:50'],
                'tipe_obat' => ['required', new isTipeObat()],
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
