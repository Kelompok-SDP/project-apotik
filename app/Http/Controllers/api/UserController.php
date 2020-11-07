<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use function GuzzleHttp\json_decode;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'nama' => ['required', 'min:3'],
            'noHp' => ['required', 'max:19', 'unique:users,noHp'],
            'password' => ['required', 'confirmed']
        ], [
            'email.unique' => ':attribute sudah pernah dipakai',
            'noHp.unique' => ':attribute sudah pernah dipakai',
            'email.required' => ':attribute harus diisi',
            'email.email' => 'email tidak sesuai format',
            'nama.required' => ':attribute harus diisi',
            'noHp.required' => ':attribute harus diisi',
            'password.required' => ':attribute harus diisi',
            'password.confirmed' => 'password dan konfirmasi tidak sama'
        ]);

        $data = $request->all();

        $namaDepan = substr($request->nama, 0, 2);
        $namaDepan = strtoupper($namaDepan);
        $newIndex = User::selectRaw('IFNULL(max(SUBSTRING(`id`,3,3)),0)+1 as newIndex')
            ->where('id', 'LIKE', "$namaDepan%")->first();

        $id = $namaDepan . str_pad($newIndex->newIndex, 3, '0', STR_PAD_LEFT);
        // var_dump($id);
        $data['id'] = $id;
        User::create($data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);



        $isLogin = User::where('email', $request->email)
            ->where('password', $request->password)->first();
        if ($isLogin) {
            $pesan = 'user terdaftar';
            // $request->session()->put('isLogin', $isLogin);
            Cookie::queue('isLogin', json_encode($isLogin), 60);
            // return json_decode($request->cookie('isLogin'));
        } else {
            $pesan = 'user tidak ada';
            return $pesan;
        }
    }

    public function home(Request $request)
    {
        $isLogin = [];
        // DD($request->session()->all());
        if (Cookie::has('isLogin')) {
            $isLogin = json_decode($request->cookie('isLogin'));
        }
        return response()->json($isLogin);
    }
}
