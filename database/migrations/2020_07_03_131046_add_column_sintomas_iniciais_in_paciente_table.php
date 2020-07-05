<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSintomasIniciaisInPacienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->text('sintomas_iniciais')->nullable()->after('tarefas_autocuidado')->nullable();
            $table->string('caso_confirmado', 50)->nullable()->after('tarefas_autocuidado')->nullable();
            $table->date('data_teste_confirmatorio')->nullable()->after('tarefas_autocuidado')->nullable();
            $table->string('teste_utilizado', 50)->nullable()->after('tarefas_autocuidado')->nullable();
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
            $table->dropColumn('sintomas_iniciais');
            $table->dropColumn('caso_confirmado');
            $table->dropColumn('data_teste_confirmatorio');
            $table->dropColumn('teste_utilizado');
        });
    }
}
