<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTdJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('td_juals', function (Blueprint $table) {
            $table->string('id',15)->primary();
            $table->foreign('id_th_jual')->references('id')->on('th_juals');
            $table->string('id_th_jual',15);
            $table->string('tipe_produk',15);
            $table->integer('harga')->length(10)->unsigned();
            $table->string('jumlah',5);
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
        Schema::connection('mysql')->dropIfExists('td_juals');
    }
}
