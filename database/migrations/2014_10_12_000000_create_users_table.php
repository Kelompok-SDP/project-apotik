<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::connection('mysql')->create('users', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('noHp', 19)->unique();
            $table->string('nama', 50);
            $table->string('email', 100);
            $table->string('password', 50);
            $table->smallInteger('status')->length(10)->unsigned()->default('1')->comment('jika 1 active, 2 terbanned');
            $table->smallInteger('status')->length(10)->unsigned()->comment('1 = admin 0 = user biasa');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql')->dropIfExists('users');
    }
}
