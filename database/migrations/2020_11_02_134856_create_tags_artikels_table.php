<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsArtikelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('tags_artikels', function (Blueprint $table) {
            $table->string('id_tag',10);
            $table->foreign('id_tag')->references('id')->on('tags');
            $table->string('id_artikel',10);
            $table->foreign('id_artikel')->references('id')->on('artikels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('tags_artikels');
    }
}
