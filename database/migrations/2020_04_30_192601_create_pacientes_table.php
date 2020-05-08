<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('data_nascimento')->nullable();
            $table->string('endereco_cep')->nullable();
            $table->string('endereco_rua')->nullable();
            $table->string('endereco_numero')->nullable();
            $table->string('endereco_bairro')->nullable();
            $table->string('endereco_cidade')->nullable();
            $table->string('endereco_uf')->nullable();
            $table->string('endereco_complemento')->nullable();
            $table->string('fone_fixo')->nullable();
            $table->string('fone_celular')->nullable();
            $table->integer('numero_pessoas_residencia')->nullable();
            $table->string('doenca_cronica')->nullable();
            $table->string('outras_doencas')->nullable();
            $table->string('remedios_consumidos')->nullable();
            $table->string('acompanhamento_medico')->nullable();
            $table->string('isolamento_residencial')->nullable();
            $table->string('alimentacao_disponivel')->nullable();
            $table->string('auxilio_terceiros')->nullable();
            $table->string('tarefas_autocuidado')->nullable();
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
        Schema::dropIfExists('pacientes');
    }
}
