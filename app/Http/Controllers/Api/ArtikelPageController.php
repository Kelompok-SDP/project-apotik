<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArtikelPageController extends Controller
{
    public function showDetail($id)
    {
        $tag = Tag::where('id', $id)->first();
        $artikel = $tag->artikels()->get();

        return compact(['tag', 'artikel']);

    }

    public function showContent($slug)
    {
        $artikel = Artikel::where('slug', $slug)->get();
        return $artikel;
    }
}
