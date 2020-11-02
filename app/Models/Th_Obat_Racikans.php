<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Th_Obat_Racikans extends Model
{
    protected $connection   = "mysql";
    protected $table        = "td_obat_racikans";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;
}
