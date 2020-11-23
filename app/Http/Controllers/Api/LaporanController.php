<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Th_Jual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //

    public function showFirst()
    {
        $dataObat = DB::table("td_juals")
            ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama as nama,obats.gambar as gambar,obats.harga as harga, obats.harga* sum(td_juals.jumlah) as totalharga, th_juals.created_at as tanggal"))
            ->join("obats", "td_juals.id_product", "obats.id")
            ->join("th_juals",  "th_juals.id", "td_juals.id_th_jual")
            ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga", "th_juals.created_at")
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        return $dataObat;
    }

    public function changePaginate($jumlah, $tipe, $secara, $orderby, $tanggalhari, $tipedata)
    {
        //tipe -> semua, perhari, perbulan, pertahun
        //tipedata -> obat, customer, pendapatan
        //secara -> asc, desc
        //order by -> tanggal, id, nama, jum
        $dataObat = null;

        //obat
        if ($tipedata == 1) {
            $dataObat = DB::table("td_juals")
                ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama as nama,obats.gambar as gambar,obats.harga as harga, obats.harga* sum(td_juals.jumlah) as totalharga, th_juals.created_at as tanggal"))
                ->join("obats", "td_juals.id_product", "obats.id")
                ->join("th_juals",  "th_juals.id", "td_juals.id_th_jual")
                ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga", "th_juals.created_at");
            //berarti nampilin semua
            if ($tipe == 0) {
                //descending
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc');
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc');
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc');
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc');
                    }
                }
            } else if ($tipe == 1) { //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari), "Y-m-d");
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereDate("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc')
                            ->whereDate("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereDate("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc')
                            ->whereDate("created_at", $date);
                    }
                }
            } else if ($tipe == 2) { //nampilin per bulan sesuai created_at
                $date = intval(date_format(date_create($tanggalhari), "m"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc')
                            ->whereMonth("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc')
                            ->whereMonth("created_at", $date);
                    }
                }
            } else if ($tipe == 3) {
                $date = intval(date_format(date_create($tanggalhari), "Y"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc')
                            ->whereYear("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc')
                            ->whereYear("created_at", $date);
                    }
                }
            }
        } else if ($tipedata == 2) {
            $dataObat = DB::table("th_juals")
                ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.id_user as id,users.nama as nama,th_juals.created_at as tanggal"))
                ->join("users", "th_juals.id_user", "users.id")
                ->join("td_juals",  "th_juals.id", "td_juals.id_th_jual")
                ->groupBy("th_juals.id_user", "users.nama", "th_juals.created_at");
            //berarti nampilin semua
            if ($tipe == 0) {
                //descending
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc');
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc');
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc');
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc');
                    }
                }
            } else if ($tipe == 1) { //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari), "Y-m-d");
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereDate("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc')
                            ->whereDate("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereDate("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc')
                            ->whereDate("created_at", $date);
                    }
                }
            } else if ($tipe == 2) { //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari), "m"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc')
                            ->whereMonth("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc')
                            ->whereMonth("created_at", $date);
                    }
                }
            } else if ($tipe == 3) {
                $date = intval(date_format(date_create($tanggalhari), "Y"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc')
                            ->whereYear("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc')
                            ->whereYear("created_at", $date);
                    }
                }
            }
        } else {
            $dataObat =DB::table("th_juals")
            ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.created_at as tanggal"))
            ->join("td_juals",  "th_juals.id","td_juals.id_th_jual")
            ->groupBy("td_juals.id_th_jual", "th_juals.created_at");
        }

        // if($tipedata == 1 || $tipedata == 2){
        //     $dataObat->paginate($jumlah);
        // }else{
        //     $dataObat->get();
        // }

        return $dataObat->paginate($jumlah);
    }


    public function search($jumlah, $tipe, $secara, $orderby, $tanggalhari, $tipedata, $search, $keyword)
    {

        //tipe -> semua, perhari, perbulan, pertahun
        //tipedata -> obat, customer, pendapatan
        //secara -> asc, desc
        //order by -> tanggal, id, nama, jum
        //search -> id, nama
        //keyword ya kata yang mau di search
        $dataObat = null;

        //obat
        if ($tipedata == 1) {
            $dataObat = DB::table("td_juals")
                ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama as nama,obats.gambar as gambar,obats.harga as harga, obats.harga* sum(td_juals.jumlah) as totalharga, th_juals.created_at as tanggal"))
                ->join("obats", "td_juals.id_product", "obats.id")
                ->join("th_juals",  "th_juals.id", "td_juals.id_th_jual")
                ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga", "th_juals.created_at");
            //berarti nampilin semua
            if ($tipe == 0) {
                //descending
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc');
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc');
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc');
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc');
                    }
                }
            } else if ($tipe == 1) { //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari), "Y-m-d");
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereDate("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc')
                            ->whereDate("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereDate("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereDate("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc')
                            ->whereDate("created_at", $date);
                    }
                }
            } else if ($tipe == 2) { //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari), "m"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc')
                            ->whereMonth("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc')
                            ->whereMonth("created_at", $date);
                    }
                }
            } else if ($tipe == 3) {
                $date = intval(date_format(date_create($tanggalhari), "Y"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'desc')
                            ->whereYear("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('jum', 'asc')
                            ->whereYear("created_at", $date);
                    }
                }
            }

            if ($search == 0) {
                $dataObat->where('td_juals.id_product', 'LIKE', "%$keyword");
            } else {

                $dataObat->where('obats.nama', 'LIKE', "%$keyword");
            }
        } else if ($tipedata == 2) {
            $dataObat = DB::table("th_juals")
                ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.id_user as id,users.nama as nama,th_juals.created_at as tanggal"))
                ->join("users", "th_juals.id_user", "users.id")
                ->join("td_juals",  "th_juals.id", "td_juals.id_th_jual")
                ->groupBy("th_juals.id_user", "users.nama", "th_juals.created_at");
            //berarti nampilin semua
            if ($tipe == 0) {
                //descending
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc');
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc');
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc');
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc');
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc');
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc');
                    }
                }
            } else if ($tipe == 1) { //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari), "Y-m-d");
                $hari = intval(date_format(date_create($tanggalhari), "d"));
                $bulan = intval(date_format(date_create($tanggalhari), "m"));
                $tahun = intval(date_format(date_create($tanggalhari), "Y"));
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereDate("created_at",$date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereDate("created_at",$date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereDate("created_at",$date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc')
                        ->whereDate("created_at",$date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                        ->whereDate("created_at",$date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereDate("created_at",$date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereDate("created_at",$date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc')
                        ->whereDate("created_at",$date);
                    }
                }
            } else if ($tipe == 2) { //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari), "m"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc')
                            ->whereMonth("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereMonth("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereMonth("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc')
                            ->whereMonth("created_at", $date);
                    }
                }
            } else if ($tipe == 3) {
                $date = intval(date_format(date_create($tanggalhari), "Y"));
                //10
                if ($secara == 0) {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'desc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'desc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'desc')
                            ->whereYear("created_at", $date);
                    }
                    //ascending
                } else {
                    if ($orderby == 0) { //tanggal
                        $dataObat->orderBy('created_at', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 1) { //id
                        $dataObat->orderBy('id', 'asc')
                            ->whereYear("created_at", $date);
                    } else if ($orderby == 2) { //nama
                        $dataObat->orderBy('nama', 'asc')
                            ->whereYear("created_at", $date);
                    } else { //jumlah
                        $dataObat->orderBy('subtotal', 'asc')
                            ->whereYear("created_at", $date);
                    }
                }
            }

            if ($search == 0) {
                $dataObat->where('th_juals.id_user', 'LIKE', "%$keyword");
            } else {
                $dataObat->where('users.nama', 'LIKE', "%$keyword");
            }
        }

        return $dataObat->paginate($jumlah);
    }
}
