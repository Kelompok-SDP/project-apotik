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
    public $timestamps      = false;

    use SoftDeletes;
}
