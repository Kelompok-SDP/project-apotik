<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\User;
use App\Rules\isPicture;
use App\Rules\isTooBig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function showAll()
    {
        //user hanya coba coba saja tidak dipake
        $user = User::all();
        $all_kategori = Kategori::paginate(5);
        $arrData = compact('user', 'all_kategori');
        return $arrData;
    }

    public function changePaginate($jumlah)
    {
        $user = User::all();
        $all_kategori = Kategori::paginate($jumlah);
        $arrData = compact('user', 'all_kategori');
        // DD($jumlah);
        return $arrData;
    }

    public function search($keywords, $jumlah)
    {
        $user = User::all();
        $all_kategori = Kategori::where('nama', 'LIKE', "$keywords%")->paginate($jumlah);
        $arrData = compact('user', 'all_kategori');
        return $arrData;
    }

    public function addKategori(Request $request)
    {
        // DD($request->all());
        if ($request->gambar) {
            $request->validate([
                'nama' => ['required', 'min:2'],
                'gambar' => ['mimes:png,jpg,jpeg', 'max:5048'],
                'slug' => ['required', 'min:3'],
            ], [
                'nama.required' => ':attribute kategori harus diisi',
                'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
                'slug.required' => 'url kategori harus diisi',
                'slug.min' => 'Karakter harus lebih panjang dari 2 huruf',
                'gambar.mimes' => 'Gambar harus bertipe png / jpg / jpeg',
                'gambar.max' => 'ukuran maksimal gambar adalah 5,48mb'
            ]);


            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/kategori';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/kategori/' . $nama_file;

            return Kategori::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'gambar' => $pathDbGambar,
                'slug' => $request->slug,
            ]);
        } else {
            $request->validate([
                'nama' => ['required', 'min:2'],
                'slug' => ['required', 'min:3'],
            ], [
                'nama.required' => ':attribute kategori harus diisi',
                'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
                'slug.required' => 'url kategori harus diisi',
                'slug.min' => 'Karakter harus lebih panjang dari 2 huruf'
            ]);

            return Kategori::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'slug' => $request->slug,
            ]);
        }
    }

    public function generateID(Request $request)
    {
        $nama = $request->nama;
        $inisial = strtoupper(substr($nama, 0, 2));

        $kode = Kategori::select(DB::raw('LPAD(IFNULL(MAX(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newKode'))
            ->where('id', 'LIKE', "$inisial%")->get();

        $newKode = strtoupper($inisial) . $kode->first()->newKode;
        return $newKode;
    }

    public function update(Request $request)
    {
        $kategori = Kategori::find($request->id);

        //karena jika user tidak pencet apa-apa maka gambar akan menjadi string path pada DB
        if (is_string($request->gambar)) {

            $request->validate([
                'nama' => ['required', 'min:2'],
                'slug' => ['required', 'min:3'],
            ], [
                'nama.required' => ':attribute kategori harus diisi',
                'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
                'slug.required' => 'url kategori harus diisi',
                'slug.min' => 'Karakter harus lebih panjang dari 2 huruf'
            ]);


            $kategori->update([
                'nama' => $request->nama,
                'slug' => $request->slug,
            ]);
        } else {
            //jika gambar bertipe object file maka update gambar pilihan user

            $request->validate([
                'nama' => ['required', 'min:2'],
                'gambar' => ['image', 'mimes:png,jpg,jpeg', 'max:5048'],
                'slug' => ['required', 'min:3'],
            ], [
                'nama.required' => ':attribute kategori harus diisi',
                'nama.min' => 'Nama harus lebih panjang dari 1 huruf',
                'slug.required' => 'url kategori harus diisi',
                'slug.min' => 'Karakter harus lebih panjang dari 2 huruf',
                'gambar.mimes' => 'Gambar harus bertipe png / jpg / jpeg',
                'gambar.image' => 'Gambar harus bertipe png / jpg / jpeg',
                'gambar.max' => 'ukuran maksimal gambar adalah 5,48mb'
            ]);

            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/kategori';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/kategori/' . $nama_file;

            $kategori->update([
                'nama' => $request->nama,
                'gambar' => $pathDbGambar,
                'slug' => $request->slug,
            ]);
        }
    }

    public function delete(Request $request)
    {
        $kategori = Kategori::find($request->id);
        $kategori->delete();
    }
}
