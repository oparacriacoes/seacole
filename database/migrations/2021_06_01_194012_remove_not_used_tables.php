<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveNotUsedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ajuda_tipos');
        Schema::dropIfExists('doenca_cronicas');
        Schema::dropIfExists('estado_emocionals');
        Schema::dropIfExists('items');
        Schema::dropIfExists('observacaos');
        Schema::dropIfExists('sintomas');

        DB::table('migrations')
            ->whereIn('migration', [
                '2020_04_30_195632_create_ajuda_tipos_table',
                '2020_05_04_102842_create_doenca_cronicas_table',
                '2020_04_30_195849_create_estado_emocionals_table',
                '2020_04_30_200545_create_items_table',
                '2020_04_30_200120_create_observacaos_table',
                '2020_04_30_194919_create_sintomas_table',
                '2020_05_23_054022_add_column_horario_sintoma_in_sintomas_table',
                '2020_06_08_152610_add_column_pressao_arterial_in_sintomas_table',
                '2020_09_10_100924_drop_evolucao_sintomas_table',
                '2020_06_08_152623_add_column_pressao_arterial_in_evolucao_sintomas_table',
                '2020_05_23_054057_add_column_horario_sintoma_in_evolucao_sintomas_table'
            ])->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
