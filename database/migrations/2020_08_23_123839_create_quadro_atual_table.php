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
            $table->string('precisou_servico')->nullable();
            $table->string('quant_ida_servico')->nullable();
            $table->string('recebeu_med_covid')->nullable();
            $table->string('nome_medicamento')->nullable();
            $table->string('teve_algum_problema')->nullable();
            $table->string('descreva_problema')->nullable();
            $table->string('precisou_internacao')->nullable();
            $table->string('precisou_ambulancia')->nullable();
            $table->string('local_internacao')->nullable();
            $table->string('nome_hospital')->nullable();
            $table->string('tempo_internacao')->nullable();
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
