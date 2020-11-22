<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $connection   = "mysql";
    protected $table        = "notifications";
    protected $primaryKey   = "id";
}
