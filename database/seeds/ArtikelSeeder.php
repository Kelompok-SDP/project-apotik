<?php

use App\Models\Artikel;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Artikel::class, 10)->make()->each(function ($artikel) {
            $depan = strtoupper(substr($artikel->title, 0, 2));
            $fakeArtikel =
                Artikel::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "$depan%")
                ->first();
            $newIndex = $depan . $fakeArtikel->newIndex;
            $artikel->id = $newIndex;

            $fakeArtikel =
                Artikel::where('slug', str_replace(' ', '-', $artikel->nama))
                ->get();
            $fakeSize = count($fakeArtikel);

            $artikel->slug = str_replace(' ', '-', $artikel->title) . "-" . $fakeSize;

            $artikel->save();
            // $artikel->tags()->save(factory(Tag::class)->make()->each(function ($tag) {
            //     $fakeTag = Tag::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')->first();
            //     $newIndex = 'T' . $fakeTag->newIndex;
            //     $tag->id = $newIndex;
            //     $tag->save();
            // }));
        });
    }
}
