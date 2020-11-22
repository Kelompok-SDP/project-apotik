<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    protected $connection   = "mysql";
    protected $table        = "kategoris";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    protected $guarded = ['deleted_at'];
    use SoftDeletes;

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'obats_kategoris', 'id_kategoris', 'id_obats');
    }

    public function alats()
    {
        return $this->belongsToMany(Alat_Kesehatan::class, 'kategoris_alat', 'id_kategori', 'id_alat');
    }

}
