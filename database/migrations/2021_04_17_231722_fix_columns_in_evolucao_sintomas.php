<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class FixColumnsInEvolucaoSintomas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evolucao_sintomas', function (Blueprint $table) {
            $table->string('data_monitoramento_old')->nullable()->after('data_monitoramento');
            $table->renameColumn('horario_monotiramento', 'horario_monitoramento');
        });

        $this->updateTableBefore();

        Schema::table('evolucao_sintomas', function (Blueprint $table) {
            $table->date('data_monitoramento')->nullable()->change();
            $table->text('sintomas_atuais')->nullable()->change();
            $table->boolean('algum_sinal')->nullable()->change();
            $table->boolean('equipe_medica')->nullable()->change();
            $table->boolean('fazendo_uso_pic')->nullable()->change();
            $table->boolean('fez_escalapes')->nullable()->change();
            $table->decimal('temperatura_atual', 8, 1)->nullable()->change();
            $table->decimal('frequencia_respiratoria_atual', 8, 1)->nullable()->change();
            $table->unsignedInteger('saturacao_atual')->nullable()->change();
            $table->unsignedInteger('frequencia_cardiaca_atual')->nullable()->change();
        });
    }

    private function updateTableBefore()
    {
        DB::beginTransaction();

        DB::table('evolucao_sintomas')->where('frequencia_respiratoria_atual', '2q')->update(['frequencia_respiratoria_atual' => 20]);
        DB::table('evolucao_sintomas')->where('frequencia_respiratoria_atual', '13Dra')->update(['frequencia_respiratoria_atual' => 13]);
        DB::table('evolucao_sintomas')->where('frequencia_respiratoria_atual', 'L')->update(['frequencia_respiratoria_atual' => null]);

        DB::table('evolucao_sintomas')->chunkById(100, function ($monitoramentos) {
            foreach ($monitoramentos as $monitoramento) {
                $sintomas_atuais = $monitoramento->sintomas_atuais ? @unserialize($monitoramento->sintomas_atuais) : null;
                $algum_sinal = $this->booleanValue($monitoramento->algum_sinal);
                $equipe_medica = $this->booleanValue($monitoramento->equipe_medica);
                $fazendo_uso_pic = $this->booleanValue($monitoramento->fazendo_uso_pic);
                $fez_escalapes = $this->booleanValue($monitoramento->fez_escalapes);
                $temperatura_atual = $monitoramento->temperatura_atual ? (string)Str::of($monitoramento->temperatura_atual)->replace(',', '.') : null;
                $frequencia_respiratoria_atual = $monitoramento->frequencia_respiratoria_atual ? (string)Str::of($monitoramento->frequencia_respiratoria_atual)->replace(',', '.') : null;
                $data_monitoramento = $monitoramento->data_monitoramento ? $this->applyFormat($monitoramento->data_monitoramento) : null;

                DB::table('evolucao_sintomas')
                    ->where('id', $monitoramento->id)
                    ->update([
                        'data_monitoramento' => $data_monitoramento,
                        'frequencia_respiratoria_atual' => $frequencia_respiratoria_atual,
                        'data_monitoramento_old' => $monitoramento->data_monitoramento,
                        'sintomas_atuais' => $sintomas_atuais,
                        'algum_sinal' => $algum_sinal,
                        'equipe_medica' => $equipe_medica,
                        'fazendo_uso_pic' => $fazendo_uso_pic,
                        'fez_escalapes' => $fez_escalapes,
                        'temperatura_atual' => $temperatura_atual
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

    private function applyFormat($date)
    {
        if (Carbon::hasFormat($date, 'd/m/Y')) {
            return Carbon::createFromFormat('d/m/Y', $date)->toDateString();
        } elseif (Carbon::hasFormat($date, 'd/m/y')) {
            return Carbon::createFromFormat('d/m/y', $date)->toDateString();
        }

        try {
            $date = new Carbon($date);
            return $date->toDateString();
        } catch (\Throwable $th) {
            Log::error($th->getMessage(), ['date' => $date]);
        }

        return '1995-07-08';
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evolucao_sintomas', function (Blueprint $table) {
            $table->string('sintomas_atuais')->nullable()->change();
            $table->string('algum_sinal')->nullable()->change();
            $table->string('equipe_medica')->nullable()->change();
            $table->string('fazendo_uso_pic')->nullable()->change();
            $table->string('fez_escalapes')->nullable()->change();
            $table->string('temperatura_atual', 8, 1)->nullable()->change();
            $table->string('saturacao_atual')->nullable()->change();
            $table->string('frequencia_respiratoria_atual')->nullable()->change();
            $table->string('frequencia_cardiaca_atual')->nullable()->change();
        });
    }
}
