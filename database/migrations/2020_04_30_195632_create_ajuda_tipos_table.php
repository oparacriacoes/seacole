<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjudaTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajuda_tipos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('paciente_id')->unsigned()->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->string('tipo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajuda_tipos');
    }
}
