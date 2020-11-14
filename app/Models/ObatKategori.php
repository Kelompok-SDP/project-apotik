<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObatKategori extends Model
{
    protected $connection   = "mysql";
    protected $table        = "obats_kategoris";
    protected $primaryKey   = null;
    public $incrementing    = false;
    public $timestamps      = false;

}
