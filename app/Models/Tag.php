<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $connection   = "mysql";
    protected $table        = "tags";
    protected $primaryKey   = "id";
    public $incrementing    = false;
    public $timestamps      = false;

    protected $guarded = ['deleted_at'];

    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'tags_artikels', 'id_tag', 'id_artikel');
    }
}
