<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Obat;
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

    public function addCart(Request $request)
    {
        $obat = Obat::find($request->id);
        $isLogin = json_decode($request->cookie('isLogin'));

        $cart = [
            'id' => $obat->id,
            'nama' => $obat->nama,
            'kemasan' => $obat->kemasan,
            'jumlah' => 1,
            'harga' => $obat->harga,
        ];

        if (session()->has('cartUser' . $isLogin->id)) {
            $found = false;
            $cartUser = session()->get('cartUser' . $isLogin->id);
            for ($i = 0; $i < count($cartUser); $i++) {
                if ($obat->id == $cartUser[$i]['id']) {
                    $cartUser[$i]['jumlah'] = $cartUser[$i]['jumlah'] + 1;
                    $found = true;
                }
            }

            if ($found) {
                session()->put('cartUser' . $isLogin->id, $cartUser);
                return response()->json(session()->get('cartUser' . $isLogin->id));
            }
        }

        session()->push('cartUser' . $isLogin->id, $cart);
        return response()->json(session()->get('cartUser' . $isLogin->id));
    }
}
