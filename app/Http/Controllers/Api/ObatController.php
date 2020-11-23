<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Alat_Kesehatan;
use App\Models\Kategori;
use App\Models\Obat;
use App\Models\Td_Jual;
use App\Rules\isTipeObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\json_decode;

class ObatController extends Controller
{
    public function showAll()
    {
        $dataObat = Obat::orderBy('harga', 'DESC')->paginate(5);
        return $dataObat;
    }

    public function generateID(Request $request)
    {
        $nama = $request->nama;
        $inisial = strtoupper(substr($nama, 0, 2));

        $kode = Obat::select(DB::raw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newKode'))
            ->where('id', 'LIKE', "$inisial%")->get();
        $newKode = strtoupper($inisial) . $kode->first()->newKode;
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

            $arrkategori = explode(",", $request->kategoris);

            Obat::create([
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

            $newKategori = Obat::find($request->id);
            foreach ($arrkategori as $tag) {
                $newKategori->kategoris()->attach($tag);
            }
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


            $arrkategori = explode(",", $request->kategoris);

            Obat::create([
                'id' => $request->id,
                'nama' => $request->nama,
                'gambar' => "",
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

            $newKategori = Obat::find($request->id);
            foreach ($arrkategori as $tag) {
                $newKategori->kategoris()->attach($tag);
            }
        }
    }

    public function update(Request $request)
    {

        $obat = Obat::find($request->id);
        if (is_string($request->gambar) || $request->gambar == null) {
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
                'gambar' => $request->gambar,
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

            DB::table('obats_kategoris')
                ->where('id_obats', $request->id)
                ->delete();

            $arrKategori = explode(",", $request->kategoris);
            foreach ($arrKategori as $value) {
                $obat->kategoris()->attach($value);
            }
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

            DB::table('obats_kategoris')
                ->where('id_obats', $request->id)
                ->delete();

            $arrKategori = explode(",", $request->kategoris);
            foreach ($arrKategori as $value) {
                $obat->kategoris()->attach($value);
            }
        }
    }

    //ini cuman coba buat home
    public function show()
    {
        $barangTerlaris = DB::table("td_juals")
            ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama,obats.gambar,obats.harga"))
            ->join("obats", "td_juals.id_product", "obats.id")
            ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga")
            ->orderBy('jum', 'desc')
            ->paginate(8);
        return $barangTerlaris;
    }

    public function showAllkategori()
    {
        $kategori = Kategori::all();
        return $kategori;
    }

    public function changePaginate($jumlah)
    {
        return Obat::paginate($jumlah);
    }

    public function search($keywords, $jumlah)
    {
        return Obat::where('nama', 'LIKE', "$keywords%")->paginate($jumlah);
    }

    public function getKategori($id)
    {
        $obat = Obat::find($id);

        $arrKategori = [];
        foreach ($obat->kategoris as $key => $value) {
            $arrKategori[] = $value->nama;
        }

        //asal for dari sini
        // DD($artikel->tags[0]->nama, $artikel->tags[1]->nama);
        return $arrKategori;
    }

    public function getDetail($id)
    {
        $obat = Obat::find($id);
        if($obat==null){
            $obat= Alat_Kesehatan::find($id);
        }
        $listKategori = $obat->kategoris()->get();
        return compact(['obat', 'listKategori']);
    }

    public function getRelated($id)
    {

        $kategori = Kategori::find($id);
        $obat=$kategori->obats()->get();
        $alat=$kategori->alats()->get();
        return compact(['obat','alat']);
    }
}
