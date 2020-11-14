<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ObatPageController extends Controller
{
    public function showAll()
    {
        $all_kategori = Kategori::orderBy('nama')->get();
        return $all_kategori;
    }

    public function showDetail($slug)
    {
        $kategori = Kategori::where('slug', $slug)->first();
        $obats = $kategori->obats()->get();

        return compact(['kategori', 'obats']);
    }
}
