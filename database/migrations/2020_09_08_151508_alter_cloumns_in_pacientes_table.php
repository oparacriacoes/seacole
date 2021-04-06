<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCloumnsInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('data_nascimento')->change();
            $table->string('data_teste_confirmatorio')->change();
            $table->string('data_inicio_sintoma')->change();
            $table->string('data_inicio_monitoramento')->change();
            $table->string('data_finalizacao_caso')->change();
            $table->string('data_parto')->change();
            $table->string('data_ultima_mestrucao')->change();
            $table->string('data_ultima_consulta')->change();
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
            //
        });
    }
}
