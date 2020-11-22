<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use function GuzzleHttp\json_decode;

class NotifPageController extends Controller
{
    public function showHeader(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $user = User::find($isLogin->id);
        $notifs = $user->notifications()->orderBy('created_at', 'desc')->get();

        $notifs = json_decode($notifs);
        // $header = $notifs[0]->data;
        // DD($header);
        //cara ambil data pada vue $header->tanggal

        return compact(['notifs']);
    }

    public function showUnread(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $user = User::find($isLogin->id);
        $notifs = $user->unreadNotifications()->orderBy('created_at', 'desc')->get();

        $notifs = json_decode($notifs);
        // $header = $notifs[0]->data;
        // DD($header);
        //cara ambil data pada vue $header->tanggal

        return compact(['notifs']);
    }

    public function showDetail($id)
    {
        $notif = Notification::find($id);
        $data = json_decode($notif);
        $data = json_decode($data->data);
        $data = $data->cart;
        // DD($data);
        //cara ambil data pada vue $data di masukan array kemudian di for

        return compact('data');
    }

    public function readDetail($id)
    {
        $isLogin = json_decode(Cookie::get('isLogin'));
        $user = User::find($isLogin->id);
        $user->notifications->where('id', $id)->markAsRead();
    }
}
