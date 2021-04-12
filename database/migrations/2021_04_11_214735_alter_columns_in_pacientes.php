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
        $this->updateDatabaseBefore();

        Schema::table('pacientes', function (Blueprint $table) {
            $table->text('acompanhamento_psicologico')->nullable()->change();
            $table->text('teste_utilizado')->nullable()->change();
            $table->text('resultado_teste')->nullable()->change();
            $table->text('doenca_cronica')->nullable()->change();
            $table->text('sistema_saude')->nullable()->change();
            $table->decimal('renda_residencia',9,2)->nullable()->change();
        });
    }

    private function updateDatabaseBefore()
    {
        DB::table('pacientes')->orderBy('id')->chunk(100, function($pacientes)
        {
            foreach ($pacientes as $paciente)
            {
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
                        'renda_residencia' => $renda_residencia
                    ]);
            }
        });
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
