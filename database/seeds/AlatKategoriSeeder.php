<?php

use App\model\AlatKategori;
use Illuminate\Database\Seeder;

class AlatKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AlatKategori::class, 10)->make()->each(function ($obat) {
            $obat->save();
        });
    }
}
