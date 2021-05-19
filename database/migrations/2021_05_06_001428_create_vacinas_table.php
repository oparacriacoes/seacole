<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacinas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('reference_key');
            $table->string('fabricante')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('doses')->default(1);
            $table->unsignedInteger('intervalo_inicial_proxima_dose')->nullable();
            $table->unsignedInteger('intervalo_final_proxima_dose')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacinas');
    }
}
