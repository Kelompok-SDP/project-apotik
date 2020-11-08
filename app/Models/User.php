<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $connection   = "mysql";
    protected $table        = "users";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    public $guarded = ['role', 'deleted_at', 'status'];
    use SoftDeletes;
}
