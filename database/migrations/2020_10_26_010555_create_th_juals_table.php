<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThJualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('th_juals', function (Blueprint $table) {
            $table->string('id',15)->primary();
            $table->string('id_user',10);
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('nama_dokter',50);
            $table->integer('total')->length(10)->unsigned();
            $table->date('tanggal');
            $table->text('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('th_juals');
    }
}
