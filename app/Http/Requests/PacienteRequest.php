<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class PacienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'renda_residencia' => (string)Str::of($this->renda_residencia)->replace('.', '')->replace(',', '.')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rulesToDate = ['date', 'nullable', 'before_or_equal:now'];
        $rulesToString = ['string', 'max:190', 'nullable'];
        $rulesToInteger = ['nullable', 'integer'];
        $rulesToArray = ['array'];
        $rulesToBoolean = ['nullable', 'string'];

        return [
            'name' => ['required', 'string', 'max:190'],
            'email' => ['email', 'max:190', 'nullable'],
            'name_social' => $rulesToString,
            'fone_fixo' => $rulesToString,
            'fone_celular' => $rulesToString,
            'data_nascimento' => $rulesToDate,
            'responsavel_residencia' => $rulesToString,
            'endereco_cep' => $rulesToString,
            'endereco_rua' => $rulesToString,
            'endereco_numero' => $rulesToString,
            'endereco_complemento' => $rulesToString,
            'endereco_bairro' => $rulesToString,
            'endereco_cidade' => $rulesToString,
            'endereco_uf' => $rulesToString,
            'ponto_referencia' => $rulesToString,
            'identidade_genero' => $rulesToString,
            'orientacao_sexual' => $rulesToString,
            'cor_raca' => $rulesToString,
            'numero_pessoas_residencia' => $rulesToInteger,
            'auxilio_emergencial' => $rulesToBoolean,
            'renda_residencia' => $rulesToString,
            'como_chegou_ao_projeto' => $rulesToString,
            'como_chegou_ao_projeto_outro' => $rulesToString,
            'nucleo_uneafro_qual' => $rulesToString,

            'data_inicio_sintoma' => $rulesToDate,
            'data_inicio_monitoramento' => $rulesToDate,
            'data_finalizacao_caso' => $rulesToDate,
            'data_inicio_ac_psicologico' => $rulesToDate,
            'data_encerramento_ac_psicologico' => $rulesToDate,
            'situacao' => $rulesToInteger,
            'agente_id' => $rulesToInteger,
            'medico_id' => $rulesToInteger,
            'psicologo_id' => $rulesToInteger,
            'articuladora_responsavel' =>  $rulesToInteger,
            'acompanhamento_psicologico' => $rulesToArray,
            'atendimento_semanal_psicologia' => ['string'],
            'horario_at_psicologia' => ['date_format:H:i', 'nullable'],

            'sintomas_iniciais' => $rulesToString,
            'data_teste_confirmatorio' => $rulesToString,
            'teste_utilizado' => $rulesToArray,
            'resultado_teste' => $rulesToArray,
            'outras_informacao' => ['nullable', 'string', 'max:10240'],

            'doenca_cronica' => $rulesToArray,
            'descreve_doencas' => $rulesToString,
            'tuberculose' => $rulesToBoolean,
            'tabagista' => $rulesToBoolean,
            'cronico_alcool' => $rulesToBoolean,
            'outras_drogas' => $rulesToBoolean,
            'remedios_consumidos' => $rulesToString,
            'gestante' => $rulesToBoolean,
            'amamenta' => $rulesToBoolean,
            'gestacao_alto_risco' => $rulesToBoolean,
            'pos_parto' => $rulesToBoolean,
            'data_parto' => $rulesToDate,
            'data_ultima_mestrucao' => $rulesToDate,
            'trimestre_gestacao' => $rulesToString,
            'motivo_risco_gravidez' => $rulesToString,
            'acompanhamento_medico' => $rulesToBoolean,
            'data_ultima_consulta' => $rulesToDate,
            'sistema_saude' => $rulesToArray,
            'acompanhamento_ubs' => $rulesToBoolean,
        ];
    }
}
