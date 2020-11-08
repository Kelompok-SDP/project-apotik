<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArtikelController extends Controller
{
    public function create(Request $request)
    {

        //adalah function buatan sendiri
        $this->validation($request);
        //karena unique hanya diperiksa waktu insert saja
        $request->validate([
            'title' => ['required', 'min:3', 'max:100', 'unique:artikels,title'],
            'slug' => ['required', 'unique:artikels,slug'],

        ], [
            'slug.required' => ':attribute harus diisi',
            'slug.unique' => ':attribute sudah ada pada website silahkan pilih :attribute lain',
            'title.unique' => ':attribute sudah ada pada website silahkan pilih :attribute lain',
            'title.min' => ':attribute minimal banyak huruf :value',
            'title.max' => ':attribute maximal banyak huruf :value',
            'title.required' => ':attribute harus diisi',

        ]);
        // DD($request->all());
        $pathDbGambar = "";
        if ($request->gambar) {
            $this->validationGambar($request);
            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/artikel';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/artikel/' . $nama_file;
        }

        // DD($request->all());
        $arrTag = explode(",", $request->tags);
        // DD($arrTag);
        Artikel::insert([
            'id' => $request->id,
            'title' => $request->title,
            'gambar' => $pathDbGambar,
            'content' => $request->content,
            'slug' => $request->slug,
        ]);

        $newArtikel = Artikel::find($request->id);
        foreach ($arrTag as $tag) {
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
        // DD($request->all());
        if (is_object($request->gambar)) {
            $request->validate([
                'gambar' => ['image', 'mimes:png,jpg,jpeg', 'max:5048']
            ], [
                'gambar.mimes' => 'Gambar harus bertipe png / jpg / jpeg',
                'gambar.image' => 'Gambar harus bertipe png / jpg / jpeg',
                'gambar.max' => 'ukuran maksimal gambar adalah 5,48mb'
            ]);

            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/artikel';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/artikel/' . $nama_file;

            $artikel->update([
                'content' => $request->content,
                'gambar' => $pathDbGambar,
            ]);
        } else {
            $artikel->update([
                'content' => $request->content,
            ]);
        }

        DB::table('tags_artikels')
            ->where('id_artikel', $request->id)
            ->delete();

        $arrTag = explode(",", $request->tags);
        foreach ($arrTag as $value) {
            $artikel->tags()->attach($value);
        }
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
            'tags' => ['required']
        ], [
            'content.required' => ':attribute harus diisi',
            'tags.required' => ':attribute harus diisi',
            'content.min' => ':attribute minimal banyak huruf 10',
            'content.max' => ':attribute maximal banyak huruf 500',
        ]);
    }

    public function validationGambar(Request $request)
    {
        $request->validate([
            'gambar' => ['image', 'mimes:png,jpg,jpeg', 'max:5048']
        ], [
            'gambar.mimes' => 'Gambar harus bertipe png / jpg / jpeg',
            'gambar.image' => 'Gambar harus bertipe png / jpg / jpeg',
            'gambar.max' => 'ukuran maksimal gambar adalah 5,48mb'
        ]);
    }

    public function showAlltag()
    {
        $tags = Tag::all();
        return $tags;
    }

    public function changePaginate($jumlah)
    {
        return Artikel::paginate($jumlah);
    }

    public function showAll()
    {
        return Artikel::paginate(5);
    }

    public function search($keywords, $jumlah)
    {
        return Artikel::where('title', 'LIKE', "$keywords%")->paginate($jumlah);
    }

    public function getTag($id)
    {
        $artikel = Artikel::find($id);

        $arrTag = [];
        foreach ($artikel->tags as $key => $value) {
            $arrTag[] = $value->nama;
        }

        //asal for dari sini
        // DD($artikel->tags[0]->nama, $artikel->tags[1]->nama);
        return $arrTag;
    }
}
