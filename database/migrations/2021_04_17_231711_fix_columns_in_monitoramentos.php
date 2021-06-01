<?php

use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixColumnsInMonitoramentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updateTableBefore();

        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->text('sintomas_atuais')->nullable()->change();
            $table->boolean('algum_sinal')->nullable()->change();
            $table->boolean('equipe_medica')->nullable()->change();
            $table->boolean('fazendo_uso_pic')->nullable()->change();
            $table->boolean('fez_escalapes')->nullable()->change();
            $table->decimal('temperatura_atual', 8, 1)->nullable()->change();
            $table->unsignedInteger('saturacao_atual')->nullable()->change();
            $table->unsignedInteger('frequencia_respiratoria_atual')->nullable()->change();
            $table->unsignedInteger('frequencia_cardiaca_atual')->nullable()->change();
            $table->renameColumn('horario_monotiramento', 'horario_monitoramento');
        });
    }

    private function updateTableBefore()
    {
        DB::beginTransaction();

        DB::table('monitoramentos')->chunkById(100, function ($monitoramentos) {
            foreach ($monitoramentos as $monitoramento) {
                $sintomas_atuais = $monitoramento->sintomas_atuais ? @unserialize($monitoramento->sintomas_atuais) : null;
                $algum_sinal = $this->booleanValue($monitoramento->algum_sinal);
                $equipe_medica = $this->booleanValue($monitoramento->equipe_medica);
                $fazendo_uso_pic = $this->booleanValue($monitoramento->fazendo_uso_pic);
                $fez_escalapes = $this->booleanValue($monitoramento->fez_escalapes);
                $temperatura_atual = $monitoramento->temperatura_atual ? (string)Str::of($monitoramento->temperatura_atual)->replace(',', '.') : null;

                DB::table('monitoramentos')
                    ->where('id', $monitoramento->id)
                    ->update([
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
        Schema::table('monitoramentos', function (Blueprint $table) {
            $table->string('sintomas_atuais')->nullable()->change();
            $table->string('algum_sinal')->nullable()->change();
            $table->string('equipe_medica')->nullable()->change();
            $table->string('fazendo_uso_pic')->nullable()->change();
            $table->string('fez_escalapes')->nullable()->change();
            $table->string('temperatura_atual', 8, 1)->nullable()->change();
            $table->unsignedInteger('saturacao_atual')->nullable()->change();
            $table->unsignedInteger('frequencia_respiratoria_atual')->nullable()->change();
            $table->unsignedInteger('frequencia_cardiaca_atual')->nullable()->change();
        });
    }
}
