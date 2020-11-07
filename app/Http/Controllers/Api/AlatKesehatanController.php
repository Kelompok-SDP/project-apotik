<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alat_Kesehatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AlatKesehatanController extends Controller
{

    public function showAll()
    {
        // dd(Alat_Kesehatan::paginate(5));
        return Alat_Kesehatan::paginate(5);
    }

    public function changePaginate($jumlah)
    {
        return Alat_Kesehatan::paginate($jumlah);
    }

    public function search($keywords, $jumlah)
    {
        return Alat_Kesehatan::where('name', 'LIKE', "$keywords%")->paginate($jumlah);
    }

    public function create(Request $request)
    {

        // dd($request);
        $request->validate([
            'nama' => ['required', 'min:3', 'max:100'],
            'harga' => ['required'],
            'stok' => ['required'],
            'satuan' => ['required'],
            'deskripsi' => ['required'],
            'manufaktur' => ['required'],
            'keterangan' => ['required'],
        ], [
            'title.min' => ':attribute minimal banyak huruf :value',
            'title.max' => ':attribute maximal banyak huruf :value',
            'title.required' => ':attribute harus diisi',

        ]);

        $pathDbGambar = "";
        if ($request->gambar) {
            $this->validationGambar($request);
            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/alat_kesehatan';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/alat_kesehatan/' . $nama_file;
        }


        $depan = "";
        if (strpos($request->title, ' ') !== false) {
            $depan = substr($request->nama, 0, 1);
            $idxSpace = strrpos($request->nama, ' ');
            $depan .= substr($request->nama, $idxSpace + 1, 1);
        } else {
            $depan .= substr($request->nama, 0, 2);
        }

        $depan = strtoupper($depan);

        $kodeId = Alat_Kesehatan::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
            ->where('id', 'LIKE', "$depan%")
            ->first();
        $newId = $depan . $kodeId->newIndex;


        Alat_Kesehatan::insert([
            'id' => $newId,
            'nama' => $request->nama,
            'gambar' => $pathDbGambar,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'deskripsi' => $request->deskripsi,
            'kemasan' => $request->kemasan,
            'manufaktur' => $request->manufaktur,
            'keterangan' => $request->keterangan,
            'slug' =>Str::slug($request->nama),
        ]);

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

        $kodeId = Alat_Kesehatan::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
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
        $alat_kesehatan = Alat_Kesehatan::find($request->id);
        // dd($alat_kesehatan);
        if (is_object($request->gambar)) {
            $request->validate([
                'nama' => ['required', 'min:3', 'max:100'],
                'harga' => ['required'],
                'stok' => ['required'],
                'satuan' => ['required'],
                'deskripsi' => ['required'],
                'manufaktur' => ['required'],
                'keterangan' => ['required'],
            ], [
                'title.min' => ':attribute minimal banyak huruf :value',
                'title.max' => ':attribute maximal banyak huruf :value',
                'title.required' => ':attribute harus diisi',

            ]);

            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/alat_kesehatan';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/alat_kesehatan/' . $nama_file;
            $alat_kesehatan->update([
                'nama' => $request->nama,
                'gambar' => $pathDbGambar,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'kemasan' => $request->kemasan,
                'manufaktur' => $request->manufaktur,
                'keterangan' => $request->keterangan,
            ]);
        } else {
            $alat_kesehatan->update([
                'nama' => $request->nama,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'deskripsi' => $request->deskripsi,
                'kemasan' => $request->kemasan,
                'manufaktur' => $request->manufaktur,
                'keterangan' => $request->keterangan,
            ]);
        }

    }

    public function delete(Request $request)
    {
        $artikel = Alat_Kesehatan::find($request->id);
        $artikel->delete();
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




}
