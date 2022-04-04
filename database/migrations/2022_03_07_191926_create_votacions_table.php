<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votacions', function (Blueprint $table) {
            $table->increments('id')->unsigned();;
            //$table->integer('id')->unsigned()->increments();
            //$table->primary('id');


			/*
			 * Datos generales
			 */
			$table->integer('sesion')->unsigned()->nulable;
			$table->integer('numeroVotacion')->unsigned()->nulable;
			$table->date('fecha')->nulable;
			$table->string('titulo')->default('');
			$table->text('textoExpediente')->default('');

			/*
			 * Datos totales
			 */
			$table->string('asentimiento')->default('');
			$table->integer('presentes')->unsigned()->nulable;
			$table->integer('afavor')->unsigned()->nulable;
			$table->integer('enContra')->unsigned()->nulable;
			$table->integer('abstenciones')->unsigned()->nulable;
			$table->integer('noVotan')->unsigned()->nulable;

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
        Schema::dropIfExists('votacions');
    }
}
