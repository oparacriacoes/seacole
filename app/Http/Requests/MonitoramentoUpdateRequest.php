<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonitoramentoUpdateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data_monitoramento' => BaseRules::DATE,
            'horario_monitoramento' => BaseRules::TIME,
            'sintomas_atuais' => BaseRules::ARRAY,
            'sintomas_outro' => BaseRules::STRING,
            'temperatura_atual' => BaseRules::STRING,
            'frequencia_cardiaca_atual' => BaseRules::INTEGER,
            'algum_sinal' => BaseRules::BOOLEAN,
            'saturacao_atual' => BaseRules::INTEGER,
            'pressao_arterial_atual' => BaseRules::STRING,
            'equipe_medica' => BaseRules::BOOLEAN,
            'frequencia_respiratoria_atual' => BaseRules::INTEGER,
            'medicamento' => BaseRules::TEXT,
            'fazendo_uso_pic' => BaseRules::BOOLEAN,
            'fez_escalapes' => BaseRules::BOOLEAN,
            'melhora_sintoma_escaldapes' => BaseRules::STRING,
            'fes_inalacao' => BaseRules::STRING,
            'melhoria_sintomas_inalacao' => BaseRules::STRING,
        ];
    }
}
