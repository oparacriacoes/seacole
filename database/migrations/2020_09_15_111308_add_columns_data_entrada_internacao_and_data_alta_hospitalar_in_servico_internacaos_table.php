<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsDataEntradaInternacaoAndDataAltaHospitalarInServicoInternacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servico_internacaos', function (Blueprint $table) {
          $table->string('data_entrada_internacao')->nullable()->after('tempo_internacao');
          $table->string('data_alta_hospitalar')->nullable()->after('data_entrada_internacao');
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
          $table->dropColumn(['data_entrada_internacao', 'data_alta_hospitalar']);
        });
    }
}
