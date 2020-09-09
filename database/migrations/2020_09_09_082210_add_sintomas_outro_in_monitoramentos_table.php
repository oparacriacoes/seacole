<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSintomasOutroInMonitoramentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('monitoramentos', function (Blueprint $table) {
          $table->string('sintomas_outro')->nullable()->after('sintomas_atuais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('monitoramentos', function (Blueprint $table) {
          Schema::dropIfExists('sintomas_outro');
        });
    }
}
