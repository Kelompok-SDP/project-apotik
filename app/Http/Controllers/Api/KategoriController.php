<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function showAll()
    {   $user = User::all();
        $all_kategori = Kategori::all();
        $arrData = compact('user','all_kategori');
        return $arrData;
    }

    public function addKategori(Request $request)
    {
        
        return Kategori::create($request->all());
    }
}
