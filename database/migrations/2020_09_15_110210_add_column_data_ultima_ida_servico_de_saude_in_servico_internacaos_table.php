<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDataUltimaIdaServicoDeSaudeInServicoInternacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->string('data_ultima_ida_servico_de_saude')->nullable()->after('quant_ida_servico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->dropColumn('data_ultima_ida_servico_de_saude');
        });
    }
}
