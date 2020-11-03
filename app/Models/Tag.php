<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $connection   = "mysql";
    protected $table        = "tags";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = true;

    protected $guarded = ['deleted_at'];
}
