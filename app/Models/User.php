<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    protected $connection   = "mysql";
    protected $table        = "users";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    use SoftDeletes;
}
