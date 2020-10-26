<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $connection   = "mysql";
    protected $table        = "users";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    use SoftDeletes;
}
