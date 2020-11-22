<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\CheckEmailUpdate;
use App\Rules\CheckNoHpUpdate;
use App\Rules\CheckPassUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    //
    public function profil(Request $request){
        $userLogin = null;
        if(Cookie::has('isLogin')){
            $userLogin = json_decode($request->cookie('isLogin'));

        }
        $jc = json_decode(Cookie::get('isLogin'));
        //dd($jc->nama);
        return response()->json($userLogin);

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
