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
            $table->string('nombre')->default('');
            $table->string('circunscripcion')->default('');
            $table->string('formacionelectoral')->default('');
            $table->date('fechacondicionplena')->nullable();
            $table->date('fechaalta')->nullable();
            $table->string('grupoparlamentario')->default('');
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
            $table->date('fechaimp')->default(\DB::raw('CURRENT_TIMESTAMP'));
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
