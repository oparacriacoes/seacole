<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablePacienteAddColumnSistemaSaude extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->date('data_inicio_sintoma')->nullable();
            $table->date('data_inicio_monitoramento')->nullable();
            $table->date('data_finalizacao_caso')->nullable();
            $table->string('name_social')->nullable();
            $table->string('identidade_genero')->nullable();
            $table->string('orientacao_sexual')->nullable();
            $table->string('auxilio_emergencial')->nullable();
            $table->string('descreve_doencas')->nullable();
            $table->string('tuberculose')->nullable();
            $table->string('tabagista')->nullable();
            $table->string('cronico_alcool')->nullable();
            $table->string('outras_drogas')->nullable();
            $table->string('gestante')->nullable();
            $table->string('amamenta')->nullable();
            $table->string('gestacao_alto_risco')->nullable();
            $table->string('pos_parto')->nullable();
            $table->date('data_parto')->nullable();
            $table->date('data_ultima_mestrucao')->nullable();
            $table->string('trimestre_gestacao')->nullable();
            $table->string('motivo_risco_gravidez')->nullable();
            $table->date('data_ultima_consulta')->nullable();
            $table->string('sistema_saude')->nullable();
            $table->string('acompanhamento_ubs')->nullable();
            $table->string('valor_familia')->nullable();
            $table->string('outras_informacao')->nullable();
            $table->string('resultado_teste')->after('teste_utilizado')->nullable();

            $table->bigInteger('articuladora_responsavel')->unsigned()->after('medico_id')->nullable();

            $table->foreign('articuladora_responsavel')->references('id')->on('articuladoras');
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
            $table->dropForeign('articuladoras_articuladora_responsavel_foreign');
            $table->dropColumn('data_inicio_sintoma');
            $table->dropColumn('data_inicio_monitoramento');
            $table->dropColumn('data_finalizacao_caso');
            $table->dropColumn('name_social');
            $table->dropColumn('identidade_genero');
            $table->dropColumn('orientacao_sexual');
            $table->dropColumn('auxilio_emergencial');
            $table->dropColumn('descreve_doencas');
            $table->dropColumn('tuberculose');
            $table->dropColumn('tabagista');
            $table->dropColumn('cronico_alcool');
            $table->dropColumn('outras_drogas');
            $table->dropColumn('gestante');
            $table->dropColumn('amamenta');
            $table->dropColumn('gestacao_alto_risco');
            $table->dropColumn('pos_parto');
            $table->dropColumn('data_parto');
            $table->dropColumn('data_ultima_mestrucao');
            $table->dropColumn('trimestre_gestacao');
            $table->dropColumn('motivo_risco_gravidez');
            $table->dropColumn('data_ultima_consulta');
            $table->dropColumn('sistema_saude');
            $table->dropColumn('acompanhamento_ubs');
            $table->dropColumn('resultado_teste');
        });
    }
}
