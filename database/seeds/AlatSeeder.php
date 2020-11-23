<?php

use App\Models\Alat_Kesehatan;
use Illuminate\Database\Seeder;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Alat_Kesehatan::class, 10)->make()->each(function ($obat) {
            $depan = strtoupper(substr($obat->nama, 0, 2));
            $fakeobat =
            Alat_Kesehatan::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "$depan%")
                ->first();
            $newIndex = $depan . $fakeobat->newIndex;
            $obat->id = $newIndex;
            $fakeArtikel =Alat_Kesehatan::where('slug', str_replace(' ', '-', $obat->nama))
            ->get();
            $fakeSize = count($fakeArtikel);

            $obat->slug = str_replace(' ', '-', $obat->nama) . "-" . $fakeSize;
            $obat->save();
        });
    }
}
