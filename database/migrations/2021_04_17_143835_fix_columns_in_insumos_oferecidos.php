<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixColumnsInInsumosOferecidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updateTableBefore();

        Schema::table('insumos_oferecidos', function (Blueprint $table) {
            $table->boolean('condicao_ficar_isolada')->nullable()->change();
            $table->boolean('tem_comida')->nullable()->change();
            $table->boolean('tem_alguem')->nullable()->change();
            $table->boolean('tarefas_autocuidado')->nullable()->change();
            $table->boolean('tratamento_prescrito')->nullable()->change();
            $table->boolean('oximetro_devolvido')->nullable()->change();
            $table->text('tratamento_financiado')->nullable()->change();
            $table->text('precisa_tipo_ajuda')->nullable()->change();
            $table->text('material_entregue')->nullable()->change();
        });
    }

    private function updateTableBefore()
    {
        DB::beginTransaction();

        DB::table('insumos_oferecidos')->chunkById(100, function ($insumos) {
            foreach ($insumos as $insumo) {
                $condicao_ficar_isolada = $this->booleanValue($insumo->condicao_ficar_isolada);
                $tem_comida = $this->booleanValue($insumo->tem_comida);
                $tem_alguem = $this->booleanValue($insumo->tem_alguem);
                $tarefas_autocuidado = $this->booleanValue($insumo->tarefas_autocuidado);
                $tratamento_prescrito = $this->booleanValue($insumo->tratamento_prescrito);
                $oximetro_devolvido = $this->booleanValue($insumo->oximetro_devolvido);
                $tratamento_financiado = $insumo->tratamento_financiado ? @unserialize($insumo->tratamento_financiado) : null;
                $precisa_tipo_ajuda = $insumo->precisa_tipo_ajuda ? @unserialize($insumo->precisa_tipo_ajuda) : null;
                $material_entregue = $insumo->material_entregue ? @unserialize($insumo->material_entregue) : null;

                DB::table('insumos_oferecidos')
                    ->where('id', $insumo->id)
                    ->update([
                        'condicao_ficar_isolada' => $condicao_ficar_isolada,
                        'tem_comida' => $tem_comida,
                        'tem_alguem' => $tem_alguem,
                        'tarefas_autocuidado' => $tarefas_autocuidado,
                        'tratamento_prescrito' => $tratamento_prescrito,
                        'oximetro_devolvido' => $oximetro_devolvido,
                        'tratamento_financiado' => $tratamento_financiado,
                        'precisa_tipo_ajuda' => $precisa_tipo_ajuda,
                        'material_entregue' => $material_entregue,
                    ]);
            }
        });

        DB::commit();
    }

    private function booleanValue ($value) {
        if ($value === 'sim') {
            return 1;
        } elseif ($value === 'não') {
            return 0;
        }
        return null;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insumos_oferecidos', function (Blueprint $table) {
            $table->string('condicao_ficar_isolada')->nullable()->change();
            $table->string('tem_comida')->nullable()->change();
            $table->string('tem_alguem')->nullable()->change();
            $table->string('tarefas_autocuidado')->nullable()->change();
            $table->string('tratamento_prescrito')->nullable()->change();
            $table->string('oximetro_devolvido')->nullable()->change();
            $table->string('tratamento_financiado')->nullable()->change();
            $table->string('precisa_tipo_ajuda')->nullable()->change();
            $table->string('material_entregue')->nullable()->change();
        });
    }
}
