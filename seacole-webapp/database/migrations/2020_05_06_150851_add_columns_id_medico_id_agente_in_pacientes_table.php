<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIdMedicoIdAgenteInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
          $table->bigInteger('medico_id')->unsigned()->after('user_id');
          $table->foreign('medico_id')->references('id')->on('medicos');
          $table->bigInteger('agente_id')->unsigned()->after('user_id');
          $table->foreign('agente_id')->references('id')->on('agentes');
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
          $table->dropForeign('pacientes_medico_id_foreign');
          $table->dropColumn('medico_id');
          $table->dropForeign('pacientes_agente_id_foreign');
          $table->dropColumn('agente_id');
        });
    }
}
