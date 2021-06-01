<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AlterColumnsInPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updateTableBefore();

        Schema::table('pacientes', function (Blueprint $table) {
            $table->text('acompanhamento_psicologico')->nullable()->change();
            $table->text('teste_utilizado')->nullable()->change();
            $table->text('resultado_teste')->nullable()->change();
            $table->text('doenca_cronica')->nullable()->change();
            $table->text('sistema_saude')->nullable()->change();
            $table->decimal('renda_residencia', 9, 2)->nullable()->change();

            $table->boolean('auxilio_emergencial')->nullable()->change();
            $table->boolean('tuberculose')->nullable()->change();
            $table->boolean('tabagista')->nullable()->change();
            $table->boolean('cronico_alcool')->nullable()->change();
            $table->boolean('outras_drogas')->nullable()->change();
            $table->boolean('gestante')->nullable()->change();
            $table->boolean('amamenta')->nullable()->change();
            $table->boolean('gestacao_alto_risco')->nullable()->change();
            $table->boolean('pos_parto')->nullable()->change();
            $table->boolean('acompanhamento_ubs')->nullable()->change();
            $table->boolean('acompanhamento_medico')->nullable()->change();
        });
    }

    private function updateTableBefore()
    {
        DB::beginTransaction();

        DB::table('pacientes')->orderBy('id')->chunk(100, function ($pacientes) {
            foreach ($pacientes as $paciente) {
                $acompanhamento_psicologico = $paciente->acompanhamento_psicologico ? @unserialize($paciente->acompanhamento_psicologico) : null;
                $teste_utilizado = $paciente->teste_utilizado ? @unserialize($paciente->teste_utilizado) : null;
                $resultado_teste = $paciente->resultado_teste ? @unserialize($paciente->resultado_teste) : null;
                $doenca_cronica = $paciente->doenca_cronica ? @unserialize($paciente->doenca_cronica) : null;
                $sistema_saude = $paciente->sistema_saude ? @unserialize($paciente->sistema_saude) : null;
                $renda_residencia = $paciente->renda_residencia ? (string)Str::of($paciente->renda_residencia)->replace('.', '')->replace(',', '.') : null;

                DB::table('pacientes')
                    ->where('id', $paciente->id)
                    ->update([
                        'acompanhamento_psicologico' => $acompanhamento_psicologico,
                        'teste_utilizado' => $teste_utilizado,
                        'resultado_teste' => $resultado_teste,
                        'doenca_cronica' => $doenca_cronica,
                        'sistema_saude' => $sistema_saude,
                        'renda_residencia' => $renda_residencia,
                        'auxilio_emergencial' => $this->booleanValue($paciente->auxilio_emergencial),
                        'tuberculose' => $this->booleanValue($paciente->tuberculose),
                        'tabagista' => $this->booleanValue($paciente->tabagista),
                        'cronico_alcool' => $this->booleanValue($paciente->cronico_alcool),
                        'outras_drogas' => $this->booleanValue($paciente->outras_drogas),
                        'gestante' => $this->booleanValue($paciente->gestante),
                        'amamenta' => $this->booleanValue($paciente->amamenta),
                        'gestacao_alto_risco' => $this->booleanValue($paciente->gestacao_alto_risco),
                        'pos_parto' => $this->booleanValue($paciente->pos_parto),
                        'acompanhamento_ubs' => $this->booleanValue($paciente->acompanhamento_ubs),
                        'acompanhamento_medico' => $this->booleanValue($paciente->acompanhamento_medico),
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
        Schema::table('pacientes', function (Blueprint $table) {
            //
        });
    }
}
