<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdObatRacikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('td_obat_racikans', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('id_th_obat_racikans',15);
            $table->foreign('id_th_obat_racikans')->references('id')->on('th_obat_racikans');
            $table->string('id_obat',10);
            $table->foreign('id_obat')->references('id')->on('obats');
            $table->integer('jumlah')->length(5)->unsigned();
            $table->integer('harga')->length(10)->unsigned();
            $table->integer('subtotal')->length(10)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('td_obat_racikans');
    }
}
