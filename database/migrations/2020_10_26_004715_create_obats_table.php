<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('obats', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('nama', 50);
            $table->string('gambar', 255)->nullable();
            $table->string('tipe_obat', 15);
            $table->integer('harga')->length(10)->unsigned();
            $table->string('indikasi', 100);
            $table->integer('stok')->length(10)->unsigned();
            $table->string('satuan', 10);
            $table->string('kemasan', 100);
            $table->text('deskripsi')->nullable();
            $table->string('komposisi', 255);
            $table->string('dosis', 100);
            $table->string('segmentasi', 25);
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
        Schema::connection('mysql')->dropIfExists('obats');
    }
}
