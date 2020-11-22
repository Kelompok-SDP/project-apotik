<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use function GuzzleHttp\json_decode;

class NotifPageController extends Controller
{
    public function showAll(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $user = User::find($isLogin->id);
        $notifs = $user->notifications()->get();

        // $header = [];
        // $detail = [];

        // foreach ($notifs as $key => $value) {
        //     // $header[] = $value->data;
        //     echo $value->data['tanggal'] . "<br>";
        //     echo $value->data['total'] . "<br>";

        //     foreach ($value->data['cart'] as $key => $value1) {
        //         // $detail[] = $value1;
        //         echo $value1['id'] . "<br>";
        //         echo $value1['nama'] . "<br>";
        //         echo $value1['jumlah'] . "<br>";
        //         echo $value1['subtotal'] . "<br>";
        //     }
        // }


        return compact(['notifs']);
    }
}
