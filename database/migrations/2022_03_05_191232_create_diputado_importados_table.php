<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiputadoImportadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diputado_importados', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            //$table->primary('id');
            $table->string('nombre');
            $table->string('circunscripcion');
            $table->string('formacionelectoral');
            $table->date('fechacondicionplena');
            $table->date('fechaalta');
            $table->string('grupoparlamentario');
            $table->date('fechaaltagrupo');
            $table->text('biografia');
            $table->integer('numero')->unsigned();
            $table->string('urlperfil');
            $table->string('urlfoto');
            $table->string('urlescaño');
            $table->text('biografiahtml');
            $table->boolean('revisado')->default(false);
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
        Schema::dropIfExists('diputado_importados');
    }
}
