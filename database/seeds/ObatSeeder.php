<?php

use App\Models\Obat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Obat::class, 10)->make()->each(function ($obat) {
            $depan = strtoupper(substr($obat->nama, 0, 2));
            $fakeobat =
            Obat::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "$depan%")
                ->first();
            $newIndex = $depan . $fakeobat->newIndex;
            $obat->id = $newIndex;

            $obat->save();
        });
    }
}
