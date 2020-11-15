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
            // DD($cartUser);
            return $cartUser;
        }
    }
}
