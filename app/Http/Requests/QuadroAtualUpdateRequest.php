<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuadroAtualUpdateRequest extends FormRequest
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
            'primeira_sintoma' => BaseRules::TEXT,
            'sintomas_manifestados' => BaseRules::ARRAY,
            'temperatura_max' => BaseRules::STRING,
            'saturacao_baixa' => BaseRules::INTEGER,
            'frequencia_max' => BaseRules::INTEGER,
            'data_temp_max' => BaseRules::DATE,
            'data_sat_max' => BaseRules::DATE,
            'data_freq_max' => BaseRules::DATE,
            'desfecho' => BaseRules::STRING,
            'sequelas' =>BaseRules::ARRAY,
            'outra_sequela_qual' => BaseRules::STRING,
            'algo_mais_sobre_caso' => BaseRules::TEXT,
        ];
    }
}
