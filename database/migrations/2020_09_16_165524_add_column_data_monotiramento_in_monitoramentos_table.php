<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDataMonotiramentoInMonitoramentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitoramentos', function (Blueprint $table) {
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
        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->dropColumn('data_monitoramento');
        });
    }
}
