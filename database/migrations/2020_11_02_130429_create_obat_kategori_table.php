<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('obats_kategoris', function (Blueprint $table) {
            $table->string("id_obats",15)->references("id")->on("obats");;
            $table->string("id_kategoris",10)->references("id")->on("kategoris");;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('obats_kategoris');
    }
}
