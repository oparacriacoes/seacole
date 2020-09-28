<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInQuadroAtualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quadro_atual', function (Blueprint $table) {
          $table->string('desfecho')->nullable()->after('data_freq_max');
          $table->string('sequelas')->nullable()->after('desfecho');
          $table->string('outra_sequela_qual')->nullable()->after('sequelas');
          $table->string('algo_mais_sobre_caso')->nullable()->after('outra_sequela_qual');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quadro_atual', function (Blueprint $table) {
          $table->dropColumn(['desfecho', 'sequelas', 'outra_sequela_qual', 'algo_mais_sobre_caso']);
        });
    }
}
