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
            $table->date('data_nascimento');
            $table->string('endereco_cep');
            $table->string('endereco_rua');
            $table->string('endereco_numero');
            $table->string('endereco_bairro');
            $table->string('endereco_cidade');
            $table->string('endereco_uf');
            $table->string('endereco_complemento')->nullable();
            $table->string('fone_fixo')->nullable();
            $table->string('fone_celular')->nullable();
            $table->integer('numero_pessoas_residencia');
            $table->string('doenca_cronica')->nullable();
            $table->string('outras_doencas')->nullable();
            $table->string('remedios_consumidos')->nullable();
            $table->string('acompanhamento_medico');
            $table->string('isolamento_residencial');
            $table->string('alimentacao_disponivel');
            $table->string('auxilio_terceiros');
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
