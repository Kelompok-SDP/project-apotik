<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SuccessRegistrasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function GuzzleHttp\json_decode;

class UserController extends Controller
{
    public function showAll()
    {
        $user = User::orderBy('nama', 'ASC')->paginate(5);
        return $user;
    }

    public function changePaginate($jumlah)
    {
        return User::paginate($jumlah);
    }

    public function bannedUser(Request $request)
    {
        $artikel = User::find($request->id);
        $artikel->update([
            'status' => 2
        ]);
    }

    public function UnbannedUser(Request $request)
    {
        $artikel = User::find($request->id);
        $artikel->update([
            'status' => 1
        ]);
    }

    public function search($keywords, $jumlah)
    {
        return User::where('nama', 'LIKE', "$keywords%")->paginate($jumlah);
    }

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
        $data['id'] = $id;
        $data['password'] = Hash::make($request->password);
        User::create($data);
        var_dump($request->email);
        Mail::to($request->email)->send(new SuccessRegistrasi($id));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credential)) {
            if (Auth::user()->status == 2) {
                Auth::guard('web')->logout();
                return 'user sudah terbanned';
            }

            $pesan = 'user terdaftar';
            $isLogin = Auth::user();
            Auth::login(Auth::user());

            Cookie::queue('isLogin', json_encode($isLogin), 3600);
        } else {
            $pesan = 'user tidak ada';
            return $pesan;
        }
    }

    public function logout()
    {
        if (Cookie::has('isLogin')) {
            Cookie::queue(Cookie::forget('isLogin'));
            Auth::guard('web')->logout();
        }
    }

    public function home(Request $request)
    {
        $isLogin = [];
        if (Cookie::has('isLogin')) {
            $isLogin = json_decode($request->cookie('isLogin'), true);
        }
        // DD($isLogin);
        return $isLogin;
    }
}
