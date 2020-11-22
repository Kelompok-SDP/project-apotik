<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Th_Jual extends Model
{
    protected $connection   = "mysql";
    protected $table        = "th_juals";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = true;

    // use SoftDeletes;

    public function td_jual()
    {
        return $this->hasMany(Td_Jual::class, 'id_th_jual', 'id');
    }

    public function obats(){
        return $this->belongsToMany(Obat::class,"td_juals","id_th_jual","id_product")
                    ->withPivot("tipe_produk","harga","jumlah","subtotal")
                    ->as("obats");
    }
}
