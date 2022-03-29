<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervencions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            //$table->primary('id');

            $table->integer('legislatura')->unsigned();
            $table->string('objeto');
            $table->date('sesion');
            $table->string('organo');
            $table->string('fase');
            $table->string('tipoIntervencion');
            $table->integer('diputado_id')->unsigned();
            $table->foreign('diputado_id')->references('id')->on('diputados')->onDelete('cascade');
            $table->string('cargo')->default('');
            $table->time('inicio');
            $table->time('fin');

            $table->string('enlaceDiferido')->default('');
            $table->string('enlaceDescargaDirecta')->default('');
            $table->string('enlaceTextoIntegro')->default('');
            $table->string('EnlacePDF')->default('');

            $table->string('enlaceSubtitles')->default('');

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
        Schema::dropIfExists('intervencions');
    }
}
