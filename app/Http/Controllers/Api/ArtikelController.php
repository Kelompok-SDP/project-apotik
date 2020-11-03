<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function create(Request $request)
    {
        //adalah function buatan sendiri
        $this->validation($request);
        //karena unique hanya diperiksa waktu insert saja
        $request->validate([
            'title' => ['required', 'min:3', 'max:100', 'unique:artikels,title'],
            'slug' => ['required', 'unique:artikels,slug']
        ], [
            'slug.required' => ':attribute harus diisi',
            'slug.unique' => ':attribute sudah ada pada website silahkan pilih :attribute lain',
            'title.unique' => ':attribute sudah ada pada website silahkan pilih :attribute lain',
            'title.min' => ':attribute minimal banyak huruf :value',
            'title.max' => ':attribute maximal banyak huruf :value',
            'title.required' => ':attribute harus diisi',

        ]);
        Artikel::create($request->all());

        $newArtikel = Artikel::find($request->id);
        foreach ($request->tags as $tag) {
            $newArtikel->tags()->attach($tag);
        }
    }

    public function generate(Request $request)
    {
        $depan = "";
        if (strpos($request->title, ' ') !== false) {
            $depan = substr($request->title, 0, 1);
            $idxSpace = strrpos($request->title, ' ');
            $depan .= substr($request->title, $idxSpace + 1, 1);
        } else {
            $depan .= substr($request->title, 0, 2);
        }

        $depan = strtoupper($depan);

        $kodeId = Artikel::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
            ->where('id', 'LIKE', "$depan%")
            ->first();
        $newId = $depan . $kodeId->newIndex;

        $slug = $request->title;
        if (strpos($request->title, ' ') !== false) {
            $slug = str_replace(' ', '-', $slug);
        }

        return compact(['slug', 'newId']);
    }

    public function update(Request $request)
    {
        $artikel = Artikel::find($request->id);

        $this->validation($request);

        $artikel->update($request->all());
    }

    public function delete(Request $request)
    {
        $artikel = Artikel::find($request->id);
        $artikel->delete();
    }

    public function validation(Request $request)
    {
        $request->validate([
            'content' => ['required', 'min:10', 'max:500'],
            'tags.*' => ['required']
        ], [
            'content.required' => ':attribute harus diisi',
            'tags.*.required' => ':attribute harus diisi',
            'content.min' => ':attribute minimal banyak huruf :value',
            'content.max' => ':attribute maximal banyak huruf :value',
        ]);
    }

    public function show()
    {
        return Artikel::all();
    }
}
