<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Rules\isTipeObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    public function showAll(){
        $dataObat = Obat::all();
        $arrData = compact( 'dataObat');
        return $dataObat;
    }

    public function generateID(Request $request)
    {
        $nama = $request->nama;
        $inisial = strtoupper(substr($nama, 0, 2));

        $kode = Obat::select(DB::raw('LPAD(IFNULL(MAX(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newKode'))
            ->where('id', 'LIKE', "$inisial%")->get();

        $newKode = "OB".strtoupper($inisial) . $kode->first()->newKode;
        return $newKode;
    }

    public function delete(Request $request)
    {
        $obat = Obat::find($request->id);
        $obat->delete();
    }


    public function create(Request $request)
    {

        if ($request->gambar) {
            $request->validate([
                'nama' => ['required', 'max:50'],
                'gambar' => ['file', 'image', 'mimes:png,jpg,jpeg', 'max:5048'],
                'harga' => ['required', 'numeric'],
                'indikasi' => ['required'],
                'stok' => ['required', 'numeric'],
                'satuan' => ['required'],
                'kemasan' => ['required'],
                'komposisi' => ['required'],
                'dosis' => ['required', 'max:100'],
                'segmentasi' => ['required'],
                'manufaktur' => ['required'],
            ]);

            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/obat';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/obat/' . $nama_file;

            return Obat::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'gambar' => $pathDbGambar,
                'harga' => $request->harga,
                'indikasi' => $request->indikasi,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'kemasan' => $request->kemasan,
                'deskripsi' => $request->deskripsi,
                'komposisi' => $request->komposisi,
                'dosis' => $request->dosis,
                'segmentasi' => $request->segmentasi,
                'manufaktur' => $request->manufaktur,
                'keterangan' => $request->keterangan,
            ]);




        } else {
             $request->validate([
                'nama' => ['required', 'max:50'],
                'harga' => ['required', 'numeric'],
                'indikasi' => ['required'],
                'stok' => ['required', 'numeric'],
                'satuan' => ['required'],
                'kemasan' => ['required'],
                'komposisi' => ['required'],
                'dosis' => ['required', 'max:100'],
                'segmentasi' => ['required'],
                'manufaktur' => ['required'],
            ]);


            return Obat::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'gambar' =>"",
                'harga' => $request->harga,
                'indikasi' => $request->indikasi,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'kemasan' => $request->kemasan,
                'deskripsi' => $request->deskripsi,
                'komposisi' => $request->komposisi,
                'dosis' => $request->dosis,
                'segmentasi' => $request->segmentasi,
                'manufaktur' => $request->manufaktur,
                'keterangan' => $request->keterangan,
            ]);
        }


    }

    public function update(Request $request){

        $obat = Obat::find($request->id);
        if (is_string($request->gambar)) {
            $request->validate([
                'nama' => ['required', 'max:50'],
                'harga' => ['required', 'numeric'],
                'indikasi' => ['required'],
                'stok' => ['required', 'numeric'],
                'satuan' => ['required'],
                'kemasan' => ['required'],
                'komposisi' => ['required'],
                'dosis' => ['required', 'max:100'],
                'segmentasi' => ['required'],
                'manufaktur' => ['required'],
            ]);

            $obat->update([
                'id' => $request->id,
                'nama' => $request->nama,
                'gambar' =>$request->gambar,
                'harga' => $request->harga,
                'indikasi' => $request->indikasi,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'kemasan' => $request->kemasan,
                'deskripsi' => $request->deskripsi,
                'komposisi' => $request->komposisi,
                'dosis' => $request->dosis,
                'segmentasi' => $request->segmentasi,
                'manufaktur' => $request->manufaktur,
                'keterangan' => $request->keterangan,
            ]);


        } else {


            $request->validate([
                'nama' => ['required', 'max:50'],
                'gambar' => ['file', 'image', 'mimes:png,jpg,jpeg', 'max:5048'],
                'harga' => ['required', 'numeric'],
                'indikasi' => ['required'],
                'stok' => ['required', 'numeric'],
                'satuan' => ['required'],
                'kemasan' => ['required'],
                'komposisi' => ['required'],
                'dosis' => ['required', 'max:100'],
                'segmentasi' => ['required'],
                'manufaktur' => ['required'],
            ]);


            $file = $request->file('gambar');
            $nama_file = time() . '-' . $file->getClientOriginalName();
            $tujuan = 'img_database/obat';
            $file->move($tujuan, $nama_file);
            $pathDbGambar = '/img_database/obat/' . $nama_file;

            $obat->update([
                'id' => $request->id,
                'nama' => $request->nama,
                'gambar' => $pathDbGambar,
                'harga' => $request->harga,
                'indikasi' => $request->indikasi,
                'stok' => $request->stok,
                'satuan' => $request->satuan,
                'kemasan' => $request->kemasan,
                'deskripsi' => $request->deskripsi,
                'komposisi' => $request->komposisi,
                'dosis' => $request->dosis,
                'segmentasi' => $request->segmentasi,
                'manufaktur' => $request->manufaktur,
                'keterangan' => $request->keterangan,
            ]);


        }
    }

    //ini cuman coba buat home
    public function show()
    {
        // var_dump(Obat::all());
        return Obat::paginate(5);
    }
}
