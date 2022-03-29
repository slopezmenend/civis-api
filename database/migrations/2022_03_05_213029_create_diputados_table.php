<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiputadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diputados', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            //$table->primary('id');
            $table->string('nombrecompleto');
            $table->string('nombre');
            $table->string('apellidos');
            $table->integer('sexo_id')->unsigned();
            $table->foreign('sexo_id')->references('id')->on('sexos')->onDelete('cascade');
            $table->integer('estadocivil_id')->unsigned();
            $table->foreign('estadocivil_id')->references('id')->on('estado_civils')->onDelete('cascade');
            $table->bigInteger('nhijos');
            $table->date('fechanacimiento');
            $table->string('estudios');
            $table->integer('circunscripcion_id')->unsigned();
            $table->foreign('circunscripcion_id')->references('id')->on('circunscripciones')->onDelete('cascade');
            $table->integer('partido_id')->unsigned();
            $table->foreign('partido_id')->references('id')->on('partidos')->onDelete('cascade');
            $table->integer('grupo_id')->unsigned();
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->date('fechacondicionplena');
            $table->date('fechaalta');
            //$table->string('grupoparlamentario');
            $table->date('fechaaltagrupo');
            $table->longText('biografia');
            $table->date('fechaimportado');
            $table->date('fecharevision');
            $table->timestamps();

            //$table->index('id_circunscripcion');
            //$table->foreign('id_circunscripcion')->references('id')->on('circunscripcions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diputados');
    }
}
