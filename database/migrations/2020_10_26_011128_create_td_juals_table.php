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
        Schema::create('td_juals', function (Blueprint $table) {
            $table->string('id',15)->primary();
            $table->foreign('id_th_jual')->references('id')->on('th_juals');
            $table->string('id_th_jual',15);
            $table->string('tipe_produk',15);
            $table->integer('harga',10);
            $table->string('jumlah',5);
            $table->integer('subtotal',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('td_juals');
    }
}
