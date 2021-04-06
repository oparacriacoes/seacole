<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('saude_mental')->nullable()->after('articuladora_responsavel');
            $table->string('acompanhamento_psicologico')->nullable()->after('saude_mental');
            $table->string('atendimento_semanal_psicologia')->nullable()->after('acompanhamento_psicologico');
            $table->string('horario_at_psicologia')->nullable()->after('atendimento_semanal_psicologia');
            $table->string('como_chegou_ao_projeto')->nullable()->after('horario_at_psicologia');
            $table->string('como_chegou_ao_projeto_outro')->nullable()->after('como_chegou_ao_projeto');
            $table->string('nucleo_uneafro_qual')->nullable()->after('como_chegou_ao_projeto');
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
            Schema::dropColumn('saude_mental');
            Schema::dropColumn('acompanhamento_psicologico');
            Schema::dropColumn('atendimento_semanal_psicologia');
            Schema::dropColumn('horario_at_psicologia');
            Schema::dropColumn('como_chegou_ao_projeto');
            Schema::dropColumn('como_chegou_ao_projeto_outro');
            Schema::dropColumn('nucleo_uneafro_qual');
        });
    }
}
