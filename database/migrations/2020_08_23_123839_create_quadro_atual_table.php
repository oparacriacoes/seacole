<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuadroAtualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quadro_atual', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->string('primeira_sintoma')->nullable();
            $table->string('sintomas_manifestados')->nullable();
            $table->string('temperatura_max')->nullable();
            $table->string('saturacao_baixa')->nullable();
            $table->string('frequencia_max')->nullable();
            $table->string('data_temp_max')->nullable();
            $table->string('data_sat_max')->nullable();
            $table->string('data_freq_max')->nullable();
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
        Schema::dropIfExists('guadro_atual');
    }
}
