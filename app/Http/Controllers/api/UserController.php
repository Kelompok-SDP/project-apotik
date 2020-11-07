<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll()
    {
        return User::paginate(5);
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
}
