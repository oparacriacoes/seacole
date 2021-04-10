<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColunsStringToDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->date('data_nascimento')->nullable()->change();
            $table->date('data_teste_confirmatorio')->nullable()->change();
            $table->date('data_inicio_sintoma')->nullable()->change();
            $table->date('data_inicio_monitoramento')->nullable()->change();
            $table->date('data_finalizacao_caso')->nullable()->change();
            $table->date('data_parto')->nullable()->change();
            $table->date('data_ultima_mestrucao')->nullable()->change();
            $table->date('data_ultima_consulta')->nullable()->change();
            $table->date('data_encerramento_ac_psicologico')->nullable()->change();
            $table->date('data_inicio_ac_psicologico')->nullable()->change();
        });

        Schema::table('quadro_atual', function (Blueprint $table) {
            $table->date('data_temp_max')->nullable()->change();
            $table->date('data_sat_max')->nullable()->change();
            $table->date('data_freq_max')->nullable()->change();
        });

        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->date('data_ultima_ida_servico_de_saude')->nullable()->change();
            $table->date('data_entrada_internacao')->nullable()->change();
            $table->date('data_alta_hospitalar')->nullable()->change();
        });

        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->date('data_monitoramento')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('data_nascimento')->nullable()->change();
            $table->string('data_teste_confirmatorio')->nullable()->change();
            $table->string('data_inicio_sintoma')->nullable()->change();
            $table->string('data_inicio_monitoramento')->nullable()->change();
            $table->string('data_finalizacao_caso')->nullable()->change();
            $table->string('data_parto')->nullable()->change();
            $table->string('data_ultima_mestrucao')->nullable()->change();
            $table->string('data_ultima_consulta')->nullable()->change();
            $table->string('data_encerramento_ac_psicologico')->nullable()->change();
            $table->string('data_inicio_ac_psicologico')->nullable()->change();
        });

        Schema::table('quadro_atual', function (Blueprint $table) {
            $table->string('data_temp_max')->nullable()->change();
            $table->string('data_sat_max')->nullable()->change();
            $table->string('data_freq_max')->nullable()->change();
        });

        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->string('data_ultima_ida_servico_de_saude')->nullable()->change();
            $table->string('data_entrada_internacao')->nullable()->change();
            $table->string('data_alta_hospitalar')->nullable()->change();
        });

        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->string('data_monitoramento')->nullable()->change();
        });
    }
}
