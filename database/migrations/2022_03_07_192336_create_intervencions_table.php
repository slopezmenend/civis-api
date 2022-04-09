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

            $table->integer('legislatura')->unsigned()->nullable();
            $table->text('objeto')->nullable();;
            $table->date('sesion')->nullable();
            $table->text('organo')->nullable();;
            $table->string('fase')->default('');
            $table->string('tipoIntervencion')->default('');
            $table->integer('diputado_id')->unsigned()->nullable();
            $table->foreign('diputado_id')->references('id')->on('diputados')->onDelete('cascade');
            $table->string('cargo')->default('')->default('');
            $table->time('inicio')->nullable();
            $table->time('fin')->nullable();

            $table->text('enlaceDiferido')->nullable();;
            $table->text('enlaceDescargaDirecta')->nullable();;
            $table->text('enlaceTextoIntegro')->nullable();;
            $table->text('EnlacePDF')->nullable();;

            $table->text('enlaceSubtitles')->nullable();;

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
