<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoEmocionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_emocionals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->unsigned()->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->string('situacao')->nullable();
            $table->string('medo')->nullable();
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
        Schema::dropIfExists('estado_emocionals');
    }
}
