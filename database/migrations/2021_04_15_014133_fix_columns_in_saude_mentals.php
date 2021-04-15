<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixColumnsInSaudeMentals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->updateTableBefore();

        Schema::table('saude_mentals', function (Blueprint $table) {
            $table->boolean('quadro_atual')->nullable()->change();
        });
    }

    private function updateTableBefore()
    {
        DB::table('saude_mentals')->where('quadro_atual', 'sim')->update(['quadro_atual' => 1]);
        DB::table('saude_mentals')->where('quadro_atual', 'não')->update(['quadro_atual' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('saude_mentals', function (Blueprint $table) {
            //
        });
    }
}
