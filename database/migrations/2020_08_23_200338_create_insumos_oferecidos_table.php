<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsumosOferecidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insumos_oferecidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->unsigned();
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->string('condicao_ficar_isolada')->nullable();
            $table->string('tem_comida')->nullable();
            $table->string('tem_alguem')->nullable();
            $table->string('tarefas_autocuidado')->nullable();
            $table->string('precisa_tipo_ajuda')->nullable();
            $table->string('tratamento_prescrito')->nullable();
            $table->string('tratamento_financiado')->nullable();
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
        Schema::dropIfExists('insumos_oferecidos');
    }
}
