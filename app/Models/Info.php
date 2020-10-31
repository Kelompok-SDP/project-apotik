<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Info extends Model
{
    protected $connection   = "mysql";
    protected $table        = "infos";
    protected $primaryKey   = "id";
    public $incrementing    = true;
    public $timestamps      = false;

    protected $guarded = ['created_at', 'updated_at'];

    use SoftDeletes;
}
