<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Td_Obat_Racikans extends Model
{
    protected $connection   = "mysql";
    protected $table        = "td_obat_racikans";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    public function Obats()
    {
        $this->hasMany(Obat::class, "id_obat", "id");
    }
}
