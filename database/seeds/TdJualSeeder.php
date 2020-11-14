<?php

use App\Models\Obat;
use App\Models\Td_Jual;
use App\Models\Th_Jual;
use Illuminate\Database\Seeder;

class TdJualSeeder extends Seeder
{

    protected $id_td_jual=0;


    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        // dd($id_td);
        factory(Td_Jual::class, 2)->make()->each(function ($obat) {
            $id_td=$this->id_td_jual;
            $depan = date("dmy");
            $fakeobat =
            Td_Jual::selectRaw('LPAD(IFNULL(max(SUBSTRING(`id`,-3,3)),0)+1,3,0) as newIndex')
                ->where('id', 'LIKE', "%$depan%")
                ->first();
            $newIndex = "TD".$depan . $fakeobat->newIndex;
            $obat->id = $newIndex;
            $obat->id_th_jual = $id_td;
            $obat_jual=Obat::find($obat->id_product);
            $obat->harga=$obat_jual->harga;
            $obat->subtotal=$obat->harga*$obat->jumlah;
            $obat->save();

        });
    }
}
