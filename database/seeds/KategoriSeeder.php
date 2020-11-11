<?php

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Kategori::class, 10)->make()->each(function ($kategori) {
            $depan = strtoupper(substr($kategori->nama, 0, 2));
            $fakekategori =
                Kategori::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "$depan%")
                ->first();
            $newIndex = $depan . $fakekategori->newIndex;
            $kategori->id = $newIndex;

            $fakekategori =
                Kategori::where('slug', str_replace(' ', '-', $kategori->nama))
                ->get();
            $fakeSize = count($fakekategori);

            $kategori->slug = str_replace(' ', '-', $kategori->nama) . "-" . $fakeSize;
            // $kategori->gambar = $faker->image('/img_database/kategori/', 640, 480, false);
            $kategori->save();
        });
    }
}
