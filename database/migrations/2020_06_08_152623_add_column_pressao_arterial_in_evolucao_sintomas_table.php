<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPressaoArterialInEvolucaoSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evolucao_sintomas', function (Blueprint $table) {
            // $table->string('pressao_arterial')->nullable()->after('cansaco_frequencia_respiratoria');
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
            // $table->dropColumn('pressao_arterial');
        });
    }
}
