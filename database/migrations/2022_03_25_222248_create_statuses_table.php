<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->boolean('importando_diputados')->default(false);
            $table->decimal('avance_diputados', $precision = 5, $scale = 2);
            $table->boolean('importando_votaciones')->default(false);
            $table->decimal('avance_votaciones', $precision = 5, $scale = 2);
            $table->boolean('importando_intervenciones')->default(false);
            $table->decimal('avance_intervenciones', $precision = 5, $scale = 2);
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
        Schema::dropIfExists('statuses');
    }
}
