<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
  protected $fillable = [
    'user_id',
    'agente_id',
    'medico_id',
    'psicologo_id',
    'data_nascimento',
    'cor_raca',
    'endereco_cep',
    'endereco_rua',
    'endereco_numero',
    'endereco_bairro',
    'endereco_cidade',
    'endereco_uf',
    'ponto_referencia',
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

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function agente()
  {
    return $this->belongsTo('App\Agente');
  }

  public function medico()
  {
    return $this->belongsTo('App\Medico');
  }

  public function psicologo()
  {
    return $this->belongsTo('App\Psicologo');
  }

  public function sintomas()
  {
    return $this->hasMany('App\Sintoma');
  }

  public function tipos_ajuda()
  {
    return $this->hasMany('App\AjudaTipo');
  }

  public function estado_emocional()
  {
    return $this->hasOne('App\EstadoEmocional');
  }

  public function observacao()
  {
    return $this->hasOne('App\Observacao');
  }

  public function doencas_cronicas()
  {
    return $this->hasMany('App\DoencaCronica');
  }

  public function items()
  {
    return $this->hasOne('App\Item');
  }

  public function dados()
  {
    return $this->hasMany('App\EvolucaoSintoma');
  }
}
