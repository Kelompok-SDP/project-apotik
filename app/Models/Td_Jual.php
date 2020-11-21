<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Td_Jual extends Model
{
    protected $connection   = "mysql";
    protected $table        = "td_juals";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    protected $guarded = [];
    // use SoftDeletes;
}
