<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    protected $connection   = "mysql";
    protected $table        = "obats";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    protected $guarded = ['deleted_at'];
    use SoftDeletes;

    public function th_jual(){
        return $this->belongsToMany(Th_Jual::class,"td_jual","id_product","id_th_jual")
                    ->withPivot("tipe_produk","harga","jumlah","subtotal");
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'obats_kategoris', 'id_obats', 'id_kategoris');
    }
}
