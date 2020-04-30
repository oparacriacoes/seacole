<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
  protected $fillable = [
    'user_id',
    'data_nascimento',
    'endereco_cep',
    'endereco_rua',
    'endereco_numero',
    'endereco_bairro',
    'endereco_cidade',
    'endereco_uf',
    'endereco_complemento',
    'fone_fixo',
    'fone_celular',
    'numero_pessoas_residencia',
    'doenca_cronica',
    'outras_doencas',
    'remedios_consumidos',
    'acompanhamento_medico',
    'isolamento_residencial',
    'alimentacao_disponivel',
    'auxilio_terceiros',
    'tarefas_autocuidado'
  ];
}
