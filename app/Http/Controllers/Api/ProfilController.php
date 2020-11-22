<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Td_Jual;
use App\Models\Th_Jual;
use App\Models\User;
use App\Rules\CheckEmailUpdate;
use App\Rules\CheckNoHpUpdate;
use App\Rules\CheckPassUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{

    public function getDtrans($id){
        $dataDtrans=DB::table("td_juals as td")
        ->selectRaw("td.tipe_produk , td.harga , td.jumlah , td.subtotal , o.nama,o.gambar , o.id")
        ->join("obats as o","o.id","td.id_product")
        ->where("td.id_th_jual",$id)->get();
        return $dataDtrans;
    }
    public function profil(Request $request){
        $userLogin = null;
        if(Cookie::has('isLogin')){
            $userLogin = json_decode($request->cookie('isLogin'));
        }
        $dataHtrans=Th_Jual::where("id_user",$userLogin->id)->orderby("created_at","desc")->paginate(5);
        foreach ($dataHtrans as $key => $value) {
            $value->tanggal=substr(date('d-m-Y',strtotime($value->created_at)),0,10);
        }
        return compact(["userLogin","dataHtrans"]);

    }

    public function profilUpdate(Request $request){
        $request->validate([
            'email' => ['required', 'email', new CheckEmailUpdate],
            'nama' => ['required', 'min:3'],
            'noHp' => ['required', 'max:19', new CheckNoHpUpdate],
            'password' => ['required', new CheckPassUpdate],
            'passbaru' =>['confirmed']
        ], [
            'email.unique' => ':attribute sudah pernah dipakai',
            'noHp.unique' => ':attribute sudah pernah dipakai',
            'email.required' => ':attribute harus diisi',
            'email.email' => 'email tidak sesuai format',
            'nama.required' => ':attribute harus diisi',
            'noHp.required' => ':attribute harus diisi',
            'password.required' => ':attribute harus diisi',
            'passbaru.confirmed' => 'password baru dan konfirmasi tidak sama'
        ]);

        $passbaru = $request->passbaru;
        $user = User::find($request->id);
        if($passbaru != null && $passbaru != null){
            $user->update([
                "nama" =>$request->nama,
                "noHp" => $request->noHp,
                "email"=> $request->email,
                "password" =>Hash::make($request->passbaru)
            ]);
        }else{
            $user->update([
                "nama" =>$request->nama,
                "noHp" => $request->noHp,
                "email"=> $request->email,
            ]);
        }
        $userup = User::find($request->id);
        Cookie::queue('isLogin', json_encode($userup), 60);

    }
}
