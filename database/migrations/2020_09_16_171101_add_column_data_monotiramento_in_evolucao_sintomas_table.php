<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDataMonotiramentoInEvolucaoSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evolucao_sintomas', function (Blueprint $table) {
          $table->string('data_monitoramento')->nullable()->after('paciente_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evolucao_sintomas', function (Blueprint $table) {
          $table->dropColumn('data_monitoramento');
        });
    }
}
