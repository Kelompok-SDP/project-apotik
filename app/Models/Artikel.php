<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artikel extends Model
{
    protected $connection   = "mysql";
    protected $table        = "artikels";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = true;

    protected $guarded = ['deleted_at', 'created_at', 'updated_at'];
    use SoftDeletes;

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_artikels', 'id_artikel', 'id_tag');
    }
}
