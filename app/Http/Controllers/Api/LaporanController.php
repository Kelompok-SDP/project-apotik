<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Th_Jual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //

    public function showFirst(){
        $dataObat =DB::table("td_juals")
        ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama as nama,obats.gambar as gambar,obats.harga as harga, obats.harga* sum(td_juals.jumlah) as totalharga, th_juals.tanggal as tanggal"))
        ->join("obats", "td_juals.id_product", "obats.id")
        ->join("th_juals",  "th_juals.id","td_juals.id_th_jual")
        ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga","th_juals.tanggal")
        ->orderBy('tanggal', 'desc')
        ->paginate(5);
        return $dataObat;
    }

    public function changePaginate($jumlah,$tipe,$secara, $orderby,$tanggalhari,$tipedata)
    {
        //tipe -> semua, perhari, perbulan, pertahun
        //tipedata -> obat, customer, pendapatan
        //secara -> asc, desc
        //order by -> tanggal, id, nama, jum
        $dataObat = null;

        //obat
        if($tipedata == 1){
            $dataObat =DB::table("td_juals")
            ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama as nama,obats.gambar as gambar,obats.harga as harga, obats.harga* sum(td_juals.jumlah) as totalharga, th_juals.tanggal as tanggal"))
            ->join("obats", "td_juals.id_product", "obats.id")
            ->join("th_juals",  "th_juals.id","td_juals.id_th_jual")
            ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga","th_juals.tanggal")
            ;
            //berarti nampilin semua
            if($tipe == 0){
                //descending
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc');
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc');
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc');
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc');
                    }
                }
            } else if($tipe == 1){ //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari),"Y-m-d");
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->where("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->where("tanggal",$date);
                    }
                }
            } else if($tipe == 2){ //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari),"m"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereMonth("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereMonth("tanggal",$date);
                    }
                }
            } else if($tipe == 3){
                $date = intval(date_format(date_create($tanggalhari),"Y"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereYear("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereYear("tanggal",$date);
                    }
                }
            }
        } else if($tipedata ==2){
            $dataObat =DB::table("th_juals")
            ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.id_user as id,users.nama as nama,th_juals.tanggal as tanggal"))
            ->join("users", "th_juals.id_user", "users.id")
            ->join("td_juals",  "th_juals.id","td_juals.id_th_jual")
            ->groupBy("th_juals.id_user", "users.nama", "th_juals.tanggal")
            ;
             //berarti nampilin semua
             if($tipe == 0){
                //descending
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc');
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc');
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc');
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc');
                    }
                }
            } else if($tipe == 1){ //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari),"Y-m-d");
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->where("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->where("tanggal",$date);
                    }
                }
            } else if($tipe == 2){ //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari),"m"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereMonth("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereMonth("tanggal",$date);
                    }
                }
            } else if($tipe == 3){
                $date = intval(date_format(date_create($tanggalhari),"Y"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereYear("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereYear("tanggal",$date);
                    }
                }
            }
        } else {
            // $dataObat =DB::table("th_juals")
            // ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.tanggal as tanggal"))
            // ->join("td_juals",  "th_juals.id","td_juals.id_th_jual")
            // ->groupBy("td_juals.id_th_jual", "th_juals.tanggal")
            // ;
            // if($tipe == 1){

            // }
        }

        return $dataObat->paginate($jumlah);

    }


    public function search($jumlah,$tipe,$secara, $orderby,$tanggalhari,$tipedata,$search,$keyword){

        //tipe -> semua, perhari, perbulan, pertahun
        //tipedata -> obat, customer, pendapatan
        //secara -> asc, desc
        //order by -> tanggal, id, nama, jum
        //search -> id, nama
        //keyword ya kata yang mau di search
        $dataObat = null;

        //obat
        if($tipedata == 1){
            $dataObat =DB::table("td_juals")
            ->select(DB::raw("sum(td_juals.jumlah) as jum,td_juals.id_product as id,obats.nama as nama,obats.gambar as gambar,obats.harga as harga, obats.harga* sum(td_juals.jumlah) as totalharga, th_juals.tanggal as tanggal"))
            ->join("obats", "td_juals.id_product", "obats.id")
            ->join("th_juals",  "th_juals.id","td_juals.id_th_jual")
            ->groupBy("td_juals.id_product", "obats.nama", "obats.gambar", "obats.harga","th_juals.tanggal")
            ;
            //berarti nampilin semua
            if($tipe == 0){
                //descending
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc');
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc');
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc');
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc');
                    }
                }

            } else if($tipe == 1){ //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari),"Y-m-d");
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->where("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->where("tanggal",$date);
                    }
                }
            } else if($tipe == 2){ //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari),"m"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereMonth("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereMonth("tanggal",$date);
                    }
                }
            } else if($tipe == 3){
                $date = intval(date_format(date_create($tanggalhari),"Y"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereYear("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereYear("tanggal",$date);
                    }
                }
            }

            if($search == 0){
                $dataObat->where('td_juals.id_product','LIKE',"%$keyword");
            } else{

                $dataObat->where('obats.nama','LIKE',"%$keyword");
            }
        } else if($tipedata ==2){
            $dataObat =DB::table("th_juals")
            ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.id_user as id,users.nama as nama,th_juals.tanggal as tanggal"))
            ->join("users", "th_juals.id_user", "users.id")
            ->join("td_juals",  "th_juals.id","td_juals.id_th_jual")
            ->groupBy("th_juals.id_user", "users.nama", "th_juals.tanggal")
            ;
             //berarti nampilin semua
             if($tipe == 0){
                //descending
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc');
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc');
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc');
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc');
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc');
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc');
                    }
                }
            } else if($tipe == 1){ //nampilin per hari sesuai tanggal
                $date = date_format(date_create($tanggalhari),"Y-m-d");
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->where("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->where("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->where("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->where("tanggal",$date);
                    }
                }
            } else if($tipe == 2){ //nampilin per bulan sesuai tanggal
                $date = intval(date_format(date_create($tanggalhari),"m"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereMonth("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereMonth("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereMonth("tanggal",$date);
                    }
                }
            } else if($tipe == 3){
                $date = intval(date_format(date_create($tanggalhari),"Y"));
                //10
                if($secara==0){
                    if($orderby ==0){ //tanggal
                       $dataObat->orderBy('tanggal', 'desc')
                       ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'desc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'desc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat ->orderBy('jum', 'desc')
                        ->whereYear("tanggal",$date);
                    }
                //ascending
                }else{
                    if($orderby ==0){ //tanggal
                        $dataObat ->orderBy('tanggal', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby ==1){ //id
                        $dataObat->orderBy('id', 'asc')
                        ->whereYear("tanggal",$date);
                    }else if($orderby == 2){ //nama
                        $dataObat->orderBy('nama', 'asc')
                        ->whereYear("tanggal",$date);
                    }else{ //jumlah
                        $dataObat  ->orderBy('jum', 'asc')
                        ->whereYear("tanggal",$date);
                    }
                }
            }

            if($search == 0){
                $dataObat->where('th_juals.id_user','LIKE',"%$keyword");
            } else{
                $dataObat->where('users.nama','LIKE',"%$keyword");
            }
        } else {
            // $dataObat =DB::table("th_juals")
            // ->select(DB::raw("sum(td_juals.subtotal) as subtotal,th_juals.tanggal as tanggal"))
            // ->join("td_juals",  "th_juals.id","td_juals.id_th_jual")
            // ->groupBy("td_juals.id_th_jual", "th_juals.tanggal")
            // ;
            // if($tipe == 1){

            // }
        }



        return $dataObat->paginate($jumlah);
    }
}
