<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInServicoInternacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->string('precisou_servico_outro')->nullable()->after('precisou_servico');
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
            Schema::dropIfExists('precisou_servico_outro');
        });
    }
}
