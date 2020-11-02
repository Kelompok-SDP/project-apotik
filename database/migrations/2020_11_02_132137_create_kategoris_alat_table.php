<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorisAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('kategoris_alat', function (Blueprint $table) {
            $table->string('id_kategori',10);
            $table->foreign('id_kategori')->references('id')->on('kategoris');
            $table->string('id_alat',10);
            $table->foreign('id_alat')->references('id')->on('kategoris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('kategoris_alat');
    }
}
