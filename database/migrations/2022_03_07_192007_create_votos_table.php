<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            //$table->increments('id');
            //$table->primary('id');
            $table->integer('votacion_id')->unsigned()->nulable;
            $table->foreign('votacion_id')->references('id')->on('votacions')->onDelete('cascade');
            $table->integer('diputado_id')->unsigned()->nulable;
            $table->foreign('diputado_id')->references('id')->on('diputados')->onDelete('cascade');
			$table->string('voto')->default('');

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
        Schema::dropIfExists('votos');
    }
}
