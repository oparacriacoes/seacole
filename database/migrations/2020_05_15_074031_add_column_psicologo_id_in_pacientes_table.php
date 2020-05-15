<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPsicologoIdInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
          $table->bigInteger('psicologo_id')->unsigned()->after('medico_id')->nullable();
          $table->foreign('psicologo_id')->references('id')->on('psicologos');
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
          $table->dropForeign('pacientes_psicologo_id_foreign');
          $table->dropColumn('psicologo_id');
        });
    }
}
