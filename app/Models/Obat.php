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

    use SoftDeletes;
}
