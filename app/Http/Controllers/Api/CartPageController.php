<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Td_Jual;
use App\Models\Th_Jual;
use App\Models\User;
use App\Notifications\InvoicePaid;
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
                $cartUser[$i]['subtotal'] = $cartUser[$i]['jumlah'] * $cartUser[$i]['harga'];
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
                $cartUser[$i]['subtotal'] = $cartUser[$i]['jumlah'] * $cartUser[$i]['harga'];
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

    public function makeTransaction(Request $request)
    {
        $isLogin = json_decode($request->cookie('isLogin'));
        $cartUser = session()->get('cartUser' . $isLogin->id);

        $depan = date("dmy");
        $fakeobat =
            Th_Jual::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
            ->where('id', 'LIKE', "%$depan%")
            ->first();
        $newIndex = "TH" . $depan . $fakeobat->newIndex;
        $id = $newIndex;
        Th_Jual::insert([
            'id' => $id,
            'id_user' => $isLogin->id,
            'nama_dokter' => '',
            'total' => $request->grandTotal,
        ]);

        $header = Th_Jual::find($id);
        foreach ($cartUser as $key => $value) {
            $depan = date("dmy");
            $fakeobat =
                Td_Jual::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "%$depan%")
                ->first();
            $newIndex = "TD" . $depan . $fakeobat->newIndex;
            $id_td = $newIndex;

            $detail = [
                'id' => $id_td,
                'id_th_jual' => $id,
                'id_product' => $value['id'],
                'tipe_produk' => 'obat',
                'harga' => $value['harga'],
                'jumlah' => $value['jumlah'],
                'subtotal' => $value['subtotal']
            ];

            $header->td_jual()->create($detail);
        }

        $user = User::find($isLogin->id);
        $user->notify(new InvoicePaid($cartUser, $request->grandTotal));
        // session()->forget('cartUser' . $isLogin->id);
    }
}
