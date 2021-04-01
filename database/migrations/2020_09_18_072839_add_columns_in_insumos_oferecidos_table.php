<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInInsumosOferecidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insumos_oferecidos', function (Blueprint $table) {
            $table->string('material_entregue')->nullable()->after('tratamento_financiado');
            $table->string('oximetro_devolvido')->nullable()->after('material_entregue');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insumos_oferecidos', function (Blueprint $table) {
            $table->dropColumn(['material_entregue', 'oximetro_devolvido']);
        });
    }
}
