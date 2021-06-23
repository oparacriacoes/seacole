<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropForeignUserInPacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        Schema::table('pacientes', function (Blueprint $table) {
            $table->dropForeign('pacientes_user_id_foreign');
            $table->dropColumn('user_id');
        });

        DB::table('users')->where('role', '=', 'paciente')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
