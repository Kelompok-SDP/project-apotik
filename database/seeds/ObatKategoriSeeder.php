<?php

use App\Models\ObatKategori;
use Illuminate\Database\Seeder;

class ObatKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(ObatKategori::class, 10)->make()->each(function ($obat) {
            $obat->save();
        });
    }
}
