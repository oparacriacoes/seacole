<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsStringToText extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->text('descreva_problema')->nullable()->change();
            $table->text('nome_medicamento')->nullable()->change();
        });

        Schema::table('saude_mentals', function (Blueprint $table) {
            $table->text('detalhes_medos')->nullable()->change();
        });

        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->text('medicamento')->nullable()->change();
        });

        Schema::table('quadro_atual', function (Blueprint $table) {
            $table->text('primeira_sintoma')->nullable()->change();
            $table->text('algo_mais_sobre_caso')->nullable()->change();
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->text('outras_informacao')->nullable()->change();
            $table->text('descreve_doencas')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->string('descreva_problema')->nullable()->change();
            $table->string('nome_medicamento')->nullable()->change();
        });

        Schema::table('saude_mentals', function (Blueprint $table) {
            $table->string('detalhes_medos')->nullable()->change();
        });

        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->string('medicamento')->nullable()->change();
        });

        Schema::table('quadro_atual', function (Blueprint $table) {
            $table->string('primeira_sintoma')->nullable()->change();
            $table->string('algo_mais_sobre_caso')->nullable()->change();
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('outras_informacao')->nullable()->change();
            $table->string('descreve_doencas')->nullable()->change();
        });
    }
}
