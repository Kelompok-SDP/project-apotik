<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Th_Obat_Racikans extends Model
{
    protected $connection   = "mysql";
    protected $table        = "th_obat_racikans";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    public function DetailRacikan()
    {
        $this->hasMany(Td_Obat_Racikans::class, "id_th_obat_racikans", "id");
    }
}
