<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alat_Kesehatan extends Model
{
    protected $connection   = "mysql";
    protected $table        = "alat_kesehatans";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    protected $guarded = ['deleted_at'];
    protected $casts = [
        'id' => 'string',
    ];
    protected $keyType = 'string';

    use SoftDeletes;

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategoris_alat', 'id_alat', 'id_kategori');
    }
    
}
