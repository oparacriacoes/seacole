<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHorarioSintomaInSintomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sintomas', function (Blueprint $table) {
          $table->string('horario_sintoma')->nullable()->after('data_inicio_sintoma');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sintomas', function (Blueprint $table) {
          $table->dropColumn('horario_sintoma');
        });
    }
}
