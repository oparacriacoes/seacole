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
            'primeira_sintoma' => '',
            'sintomas_manifestados' => BaseRules::ARRAY,
            'temperatura_max' => '',
            'saturacao_baixa' => '',
            'frequencia_max' => '',
            'data_temp_max' => '',
            'data_sat_max' => '',
            'data_freq_max' => '',
            'desfecho' => '',
            'sequelas' =>BaseRules::ARRAY,
            'outra_sequela_qual' => '',
            'algo_mais_sobre_caso' => '',
        ];
    }
}
