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
            $table->string('nombrecompleto')->default('');
            $table->string('nombre')->default('');
            $table->string('apellidos')->default('');
            $table->integer('sexo_id')->unsigned()->nullable();
            $table->foreign('sexo_id')->references('id')->on('sexos')->onDelete('cascade');
            $table->integer('estadocivil_id')->unsigned()->nullable();
            $table->foreign('estadocivil_id')->references('id')->on('estado_civils')->onDelete('cascade');
            $table->integer('circunscripcion_id')->unsigned()->nullable();
            $table->foreign('circunscripcion_id')->references('id')->on('circunscripciones')->onDelete('cascade');
            $table->integer('partido_id')->unsigned()->nullable();
            $table->foreign('partido_id')->references('id')->on('partidos')->onDelete('cascade');
            $table->integer('grupo_id')->unsigned()->nullable();
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->date('fechacondicionplena')->nullable();
            $table->date('fechaalta')->nullable();
            //$table->string('grupoparlamentario');
            $table->date('fechaaltagrupo')->nullable();
            $table->text('biografia')->nullable();
            $table->integer('numero')->unsigned()->nullable();
            $table->text('urlperfil')->nullable();
            $table->text('urlfoto')->nullable();
            $table->text('urlescaño')->nullable();
            $table->string('email')->default('');
            $table->string('twitter')->default('');
            $table->string('facebook')->default('');
            $table->string('instagram')->default('');
            $table->string('youtube')->default('');
            $table->string('webpersonal')->default('');
            $table->date('fechaimportado')->nullable();
            $table->date('fecharevision')->nullable();
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
