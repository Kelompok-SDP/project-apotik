<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatKesehatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('alat_kesehatans', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('nama', 50);
            $table->string('gambar', 255)->nullable();
            $table->integer('harga')->length(10)->unsigned();
            $table->string('indikasi', 100)->nullable();
            $table->integer('stok')->length(10)->unsigned();
            $table->string('satuan', 10);
            $table->string('slug',50);
            $table->string('kemasan', 255);
            $table->text('deskripsi')->nullable();
            $table->string('manufaktur', 50);
            $table->text('keterangan')->nullable();
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('alat_kesehatans');
    }
}
