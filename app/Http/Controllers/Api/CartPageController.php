<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use function GuzzleHttp\json_decode;

class CartPageController extends Controller
{
    public function show(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        if (session()->has('cartUser' . $isLogin->id)) {
            $cartUser = session()->get('cartUser' . $isLogin->id);
            return $cartUser;
        }
    }

    public function addJumlah(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $cartUser = session()->get('cartUser' . $isLogin->id);
        for ($i = 0; $i < count($cartUser); $i++) {
            if ($cartUser[$i]['id'] == $request->id) {
                $cartUser[$i]['jumlah'] = $cartUser[$i]['jumlah'] + 1;
            }
        }

        return session()->put('cartUser' . $isLogin->id, $cartUser);
    }

    public function minJumlah(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $cartUser = session()->get('cartUser' . $isLogin->id);
        for ($i = 0; $i < count($cartUser); $i++) {
            if ($cartUser[$i]['id'] == $request->id) {
                $cartUser[$i]['jumlah'] = $cartUser[$i]['jumlah'] - 1;
                if ($cartUser[$i]['jumlah'] == 0) {
                    unset($cartUser);
                    $cartUser = array_values($cartUser);
                }
            }
        }

        return session()->put('cartUser' . $isLogin->id, $cartUser);
    }

    public function deleteCart(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $cartUser = session()->get('cartUser' . $isLogin->id);
        for ($i = 0; $i < count($cartUser); $i++) {
            if ($cartUser[$i]['id'] == $request->id) {
                unset($cartUser[$i]);
                $cartUser = array_values($cartUser);
            }
        }

        return session()->put('cartUser' . $isLogin->id, $cartUser);
    }
}
