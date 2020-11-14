<?php

use App\Models\Obat;
use App\Models\Td_Jual;
use App\Models\Th_Jual;
use Illuminate\Database\Seeder;

class ThJualSeeder extends Seeder
{
    protected $id_td_jual=0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Th_Jual::class, 10)->make()->each(function ($obat) {
            $depan = date("dmy");
            $fakeobat =
            Th_Jual::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "%$depan%")
                ->first();
            $newIndex = "TH".$depan . $fakeobat->newIndex;
            $obat->id = $newIndex;
            $this->id_td_jual=$newIndex;

            $obat->save();
            factory(Td_Jual::class, 2)->make()->each(function ($obat) {
                $id_td=$this->id_td_jual;
                $depan = date("dmy");
                $fakeobat =
                Td_Jual::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                    ->where('id', 'LIKE', "%$depan%")
                    ->first();
                $newIndex = "TD".$depan . $fakeobat->newIndex;
                $obat->id = $newIndex;
                $obat->id_th_jual = $this->id_td_jual;
                $obat_jual=Obat::find($obat->id_product);
                $obat->harga=$obat_jual->harga;
                $obat->subtotal=$obat->harga*$obat->jumlah;
                $obat->save();

            });
            $tamptotal =
            Td_Jual::selectRaw('sum(subtotal) as total')
                ->where('id_th_jual', $newIndex)
                ->groupBy("id")
                ->first();
            $obat->total=$tamptotal->total;
            $obat->save();

        });
    }

}
