<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function showAll()
    {
        $all_tag = Tag::paginate(5);
        return $all_tag;
    }

    public function changePaginate($jumlah)
    {
        $all_tag = Tag::paginate($jumlah);
        return $all_tag;
    }

    public function search($keywords, $jumlah)
    {
        $all_tag = Tag::where('nama', 'LIKE', "$keywords%")->paginate($jumlah);
        return $all_tag;
    }

    public function addTag(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama' => ['required', 'min:2'],
        ], [
            'nama.required' => ':attribute kategori harus diisi',
            'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
        ]);

        return Tag::create([
            'id' => $request->id,
            'nama' => $request->nama,
        ]);

    }

    public function generateID(Request $request)
    {
        $nama = $request->nama;

        $kode = Tag::select(DB::raw('LPAD(IFNULL(MAX(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newKode'))->get();

        $newKode = "T" . $kode->first()->newKode;
        return $newKode;
    }

    public function update(Request $request)
    {
        $tag = Tag::find($request->id);

        $request->validate([
            'nama' => ['required', 'min:2'],
        ], [
            'nama.required' => ':attribute tag harus diisi',
            'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
        ]);

        $tag->update([
            'nama' => $request->nama,
        ]);
    }

    public function delete(Request $request)
    {
        $tag = Tag::find($request->id);
        $tag->delete();
    }
}
