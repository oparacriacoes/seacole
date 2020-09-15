<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsDataInicioAcPsicologicoAndDataEncerramentoAcPsicologicoInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
          $table->string('data_inicio_ac_psicologico')->nullable()->after('data_finalizacao_caso');
          $table->string('data_encerramento_ac_psicologico')->nullable()->after('data_inicio_ac_psicologico');
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
          $table->dropColumn(['data_inicio_ac_psicologico', 'data_encerramento_ac_psicologico']);
        });
    }
}
