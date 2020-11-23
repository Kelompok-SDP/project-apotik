<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Td_Obat_Racikans;
use App\Models\Th_Obat_Racikans;
use App\Rules\CheckInteger;
use Illuminate\Http\Request;

class ObatRacikansController extends Controller
{
    public function showAll()
    {
        return Th_Obat_Racikans::orderBy('nama', 'ASC')->paginate(5);
    }

    public function showDetail($id)
    {
        $obat = [];
        $tdObatR = Td_Obat_Racikans::where("id_th_obat_racikans", $id)->get();
        foreach ($tdObatR as $item) {
            $tmp = Obat::where("id", $item->id_obat)->get();
            if(count($tmp) > 0){
                array_push($obat, $tmp);
            }
        }
        $arrData = compact('tdObatR', 'obat');
        return $arrData;
    }

    public function changePaginate($jumlah)
    {
        return Th_Obat_Racikans::paginate($jumlah);
    }

    public function showAllObat()
    {
        $tags = Obat::all();
        return $tags;
    }

    public function generate(Request $request)
    {
        $depan = "";
        if (strpos($request->nobatr, ' ') !== false) {
            $depan = substr($request->nobatr, 0, 1);
            $idxSpace = strrpos($request->nobatr, ' ');
            $depan .= substr($request->nobatr, $idxSpace + 1, 1);
        } else {
            $depan .= substr($request->nobatr, 0, 2);
        }

        $depan = strtoupper($depan);


        $kodeId = Th_Obat_Racikans::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
        ->first();
        $newId = "TH". $depan . $kodeId->newIndex;
        return $newId;
    }

    public function insert(Request $request)
    {
        $request->validate([
            'nama_obat_racikan' => ['required', 'min:3', 'max:50', 'unique:th_obat_racikans,nama'],
            'nama_dokter' => ['required', 'min:3', 'max:50'],
            'jml_obat' => [new CheckInteger]
        ], [
            'unique' => ':attribute sudah ada pada website silahkan isi :attribute lain',
            'min' => ':attribute minimal :min huruf',
            'max' => ':attribute maxima :mac huruf',
            'required' => ':attribute harus diisi',
        ]);

        $hitung = 0;
        $total = 0;
        $tmp = $request->id_obat;
        $tmpid = explode(",",$tmp);
        $tmp2 = $request->jml_obat;
        $tmpjml = explode(",",$tmp2);
        $tmphar = [];
        for ($i=0; $i < count($tmpid); $i++) {
            $row = Obat::where("id", $tmpid[$i])->get();
            foreach ($row as $item) {
                array_push($tmphar, $item->harga);
            }
        }

        Th_Obat_Racikans::insert([
            'id' => $request->id,
            'nama' => $request->nama_obat_racikan,
            'nama_dokter' => $request->nama_dokter,
            'total' => 0,
            'keterangan' => $request->keterangan,
        ]);

        for ($i=0; $i < count($tmpid); $i++) {
            $kodeId = Td_Obat_Racikans::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')->first();
            $newId = "TD".$kodeId->newIndex;
            $hitung = ($tmpjml[$i] * $tmphar[$i]);
            $total = $total + $hitung;
            Td_Obat_Racikans::insert([
                'id' => $newId,
                'id_th_obat_racikans' => $request->id,
                'id_obat' => $tmpid[$i],
                'jumlah' => $tmpjml[$i],
                'harga' => $tmphar[$i],
                'subtotal' => $hitung
            ]);
            $hitung = 0;
        }

        $rowUp = Th_Obat_Racikans::find($request->id);
        $rowUp->update(["total" => $total]);
    }

    public function search($keywords, $jumlah)
    {
        return Th_Obat_Racikans::where('nama', 'LIKE', "$keywords%")->paginate($jumlah);
    }
}
