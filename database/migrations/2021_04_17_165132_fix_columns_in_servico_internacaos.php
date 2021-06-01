<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixColumnsInServicoInternacaos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updateTableBefore();

        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->unsignedInteger('quant_ida_servico')->nullable()->change();
            $table->unsignedInteger('tempo_internacao')->nullable()->change();
            $table->boolean('precisou_ambulancia')->nullable()->change();
            $table->boolean('precisou_internacao')->nullable()->change();
            $table->text('teve_algum_problema')->nullable()->change();
            $table->text('recebeu_med_covid')->nullable()->change();
            $table->text('precisou_servico')->nullable()->change();
            $table->text('local_internacao')->nullable()->change();
        });
    }

    private function updateTableBefore()
    {
        DB::beginTransaction();

        DB::table('servico_internacaos')->chunkById(100, function ($servico_internacoes) {
            foreach ($servico_internacoes as $servico_internacao) {
                $precisou_internacao = $this->booleanValue($servico_internacao->precisou_internacao);
                $precisou_ambulancia = $this->booleanValue($servico_internacao->precisou_ambulancia);

                $quant_ida_servico = $servico_internacao->quant_ida_servico ? (int)$servico_internacao->quant_ida_servico : null;
                $tempo_internacao = $servico_internacao->tempo_internacao ? (int)$servico_internacao->tempo_internacao : null;

                $teve_algum_problema = $servico_internacao->teve_algum_problema ? @unserialize($servico_internacao->teve_algum_problema) : null;
                $recebeu_med_covid = $servico_internacao->recebeu_med_covid ? @unserialize($servico_internacao->recebeu_med_covid) : null;
                $precisou_servico = $servico_internacao->precisou_servico ? @unserialize($servico_internacao->precisou_servico) : null;
                $local_internacao = $servico_internacao->local_internacao ? @unserialize($servico_internacao->local_internacao) : null;

                DB::table('servico_internacaos')
                    ->where('id', $servico_internacao->id)
                    ->update([
                        'precisou_servico' => $precisou_servico,
                        'recebeu_med_covid' => $recebeu_med_covid,
                        'teve_algum_problema' => $teve_algum_problema,
                        'local_internacao' => $local_internacao,
                        'precisou_internacao' => $precisou_ambulancia,
                        'precisou_ambulancia' => $precisou_internacao,
                        'quant_ida_servico' => $quant_ida_servico,
                        'tempo_internacao' => $tempo_internacao
                    ]);
            }
        });

        DB::commit();
    }

    private function booleanValue($value)
    {
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
        Schema::table('servico_internacaos', function (Blueprint $table) {
            $table->string('quant_ida_servico')->nullable()->change();
            $table->string('tempo_internacao')->nullable()->change();
            $table->string('precisou_ambulancia')->nullable()->change();
            $table->string('precisou_internacao')->nullable()->change();
            $table->string('teve_algum_problema')->nullable()->change();
            $table->string('recebeu_med_covid')->nullable()->change();
            $table->string('precisou_servico')->nullable()->change();
            $table->string('local_internacao')->nullable()->change();
        });
    }
}
