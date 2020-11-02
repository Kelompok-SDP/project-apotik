<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThObatRacikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('th_obat_racikans', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('nama', 50);
            $table->string('nama_dokter', 50);
            $table->integer('total')->length(10)->unsigned();
            $table->string('keterangan', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('th_obat_racikans');
    }
}
