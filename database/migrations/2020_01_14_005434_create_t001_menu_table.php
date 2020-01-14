<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateT001MenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t001_menu', function (Blueprint $table) {
            $table->bigIncrements('a001_id_menu');
            $table->string('a001_descricao')->nullable();
            $table->string('a001_url')->nullable();
            $table->string('a001_ordem')->nullable();
            $table->string('a001_status')->nullable();
            $table->integer('a001_id_pai');
            $table->integer('created_at_user')->nullable();
            $table->integer('updated_at_user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t001_menu');
    }
}
