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
			$table->integer('sesion')->unsigned();
			$table->integer('numeroVotacion')->unsigned();
			$table->date('fecha');
			$table->string('titulo');
			$table->text('textoExpediente');

			/*
			 * Datos totales
			 */
			$table->string('asentimiento');
			$table->integer('presentes')->unsigned();
			$table->integer('afavor')->unsigned();
			$table->integer('enContra')->unsigned();
			$table->integer('abstenciones')->unsigned();
			$table->integer('noVotan')->unsigned();

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
