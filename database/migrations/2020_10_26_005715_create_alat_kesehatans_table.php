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
        Schema::create('alat_kesehatans', function (Blueprint $table) {
            $table->string('id',10);
            $table->primary('id');
            $table->string('nama',50);
            $table->string('gambar',255)->nullable();
            $table->string('tipe_produk',15);
            $table->integer('harga',10);
            $table->string('indikasi',100)->nullable();
            $table->integer('stok',10);
            $table->string('satuan',10);
            $table->string('kemasan',255);
            $table->text('deskripsi')->nullable();
            $table->string('manufaktur',50);
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
        Schema::dropIfExists('alat_kesehatans');
    }
}
