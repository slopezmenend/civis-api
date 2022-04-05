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
			$table->integer('sesion')->unsigned()->nullable();
			$table->integer('numeroVotacion')->unsigned()->nullable();
			$table->date('fecha')->nullable();
			$table->string('titulo')->default('');
			$table->text('textoExpediente')->default('');

			/*
			 * Datos totales
			 */
			$table->string('asentimiento')->default('');
			$table->integer('presentes')->unsigned()->nullable();
			$table->integer('afavor')->unsigned()->nullable();
			$table->integer('enContra')->unsigned()->nullable();
			$table->integer('abstenciones')->unsigned()->nullable();
			$table->integer('noVotan')->unsigned()->nullable();

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
