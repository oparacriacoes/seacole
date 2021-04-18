<?php

use Illuminate\Support\Str;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixColumnsInQuadroAtual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quadro_atual', function (Blueprint $table) {
            $this->updateTableBefore();

            $table->decimal('temperatura_max', 8, 2)->nullable()->change();
            $table->unsignedInteger('saturacao_baixa')->nullable()->change();
            $table->unsignedInteger('frequencia_max')->nullable()->change();
            $table->text('sequelas')->nullable()->change();
            $table->text('sintomas_manifestados')->nullable()->change();
        });
    }

    private function updateTableBefore()
    {
        DB::table('quadro_atual')->chunkById(100, function ($quadros_atual) {
            foreach ($quadros_atual as $quadro_atual) {
                $temperatura_max = $quadro_atual->temperatura_max ? (string)Str::of($quadro_atual->temperatura_max)->replace(',', '.') : null;
                $sequelas = $quadro_atual->sequelas ? @unserialize($quadro_atual->sequelas) : null;
                $sintomas_manifestados = $quadro_atual->sintomas_manifestados ? @unserialize($quadro_atual->sintomas_manifestados) : null;

                DB::table('quadro_atual')
                    ->where('id', $quadro_atual->id)
                    ->update([
                        'temperatura_max' => $temperatura_max,
                        'sequelas' => $sequelas,
                        'sintomas_manifestados' => $sintomas_manifestados
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
        Schema::table('quadro_atual', function (Blueprint $table) {
            $table->string('temperatura_max')->nullable()->change();
            $table->string('saturacao_baixa')->nullable()->change();
            $table->string('frequencia_max')->nullable()->change();
            $table->string('sequelas')->nullable()->change();
            $table->string('sintomas_manifestados')->nullable()->change();
        });
    }
}
