<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'agente_id',
        'medico_id',
        'psicologo_id',
        'saude_mental',
        'acompanhamento_psicologico',
        'atendimento_semanal_psicologia',
        'horario_at_psicologia',
        'como_chegou_ao_projeto',
        'como_chegou_ao_projeto_outro',
        'nucleo_uneafro_qual',
        'situacao',
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
        'responsavel_residencia',
        'renda_residencia',
        'doenca_cronica',
        'outras_doencas',
        'remedios_consumidos',
        'acompanhamento_medico',
        'isolamento_residencial',
        'alimentacao_disponivel',
        'auxilio_terceiros',
        'tarefas_autocuidado',
        'sintomas_iniciais',
        'data_teste_confirmatorio',
        'teste_utilizado',
        'data_inicio_sintoma',
        'data_inicio_monitoramento',
        'data_finalizacao_caso',
        'data_inicio_ac_psicologico',
        'data_encerramento_ac_psicologico',
        'name_social',
        'identidade_genero',
        'orientacao_sexual',
        'auxilio_emergencial',
        'descreve_doencas',
        'tuberculose',
        'tabagista',
        'cronico_alcool',
        'outras_drogas',
        'gestante',
        'amamenta',
        'gestacao_alto_risco',
        'pos_parto',
        'data_parto',
        'data_ultima_mestrucao',
        'trimestre_gestacao',
        'motivo_risco_gravidez',
        'data_ultima_consulta',
        'sistema_saude',
        'acompanhamento_ubs',
        'resultado_teste',
        'articuladora_responsavel',
        'valor_familia',
        'outras_informacao',
    ];

    /**
     * Mutators and Casts
     */
    protected $dates = [
        'data_nascimento',
        'data_teste_confirmatorio',
        'data_inicio_sintoma',
        'data_inicio_monitoramento',
        'data_finalizacao_caso',
        'data_parto',
        'data_ultima_mestrucao',
        'data_ultima_consulta',
        'data_encerramento_ac_psicologico',
        'data_inicio_ac_psicologico',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'acompanhamento_psicologico' => 'array',
        'teste_utilizado' => 'array',
        'resultado_teste' => 'array',
        'doenca_cronica' => 'array',
        'sistema_saude' => 'array',

        'auxilio_emergencial' => 'boolean',
        'tuberculose' => 'boolean',
        'tabagista' => 'boolean',
        'cronico_alcool' => 'boolean',
        'outras_drogas' => 'boolean',
        'gestante' => 'boolean',
        'amamenta' => 'boolean',
        'gestacao_alto_risco' => 'boolean',
        'pos_parto' => 'boolean',
        'acompanhamento_ubs' => 'boolean',
        'acompanhamento_medico' => 'boolean',
    ];

    public function getAgeAttribute()
    {
        return $this->data_nascimento->diffInYears(now());
    }


    /**
     * Relations
     */

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

    public function articuladora()
    {
        return $this->belongsTo('App\Articuladora');
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

    public function monitoramento()
    {
        return $this->hasOne(Monitoramento::class);
    }

    public function prontuarios()
    {
        return $this->hasMany(EvolucaoSintoma::class);
    }

    public function insumos_oferecidos()
    {
        return $this->hasOne(InsumosOferecido::class);
    }

    public function quadro_atual()
    {
        return $this->hasOne(QuadroAtual::class);
    }

    public function saude_mental()
    {
        return $this->hasOne(SaudeMental::class);
    }

    public function servico_internacao()
    {
        return $this->hasOne(ServicoInternacao::class);
    }
}
