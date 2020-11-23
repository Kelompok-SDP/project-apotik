<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class AlatKategori extends Model
{
    protected $connection   = "mysql";
    protected $table        = "kategoris_alat";
    protected $primaryKey   = null;
    public $incrementing    = false;
    public $timestamps      = false;
}
