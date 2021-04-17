<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicoInternacaoUpdateRequest extends FormRequest
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
        $rulesToDate = ['date', 'nullable', 'before_or_equal:now'];
        $rulesToString = ['string', 'max:190', 'nullable'];
        $rulesToInteger = ['nullable', 'integer'];
        $rulesToArray = ['array'];
        $rulesToBoolean = ['nullable', 'string'];

        return [
            'data_ultima_ida_servico_de_saude' => $rulesToDate,
            'data_entrada_internacao' => $rulesToDate,
            'data_alta_hospitalar' => $rulesToDate,
            'precisou_servico' => $rulesToArray,
            'local_internacao' => $rulesToArray,
            'teve_algum_problema' => $rulesToArray,
            'recebeu_med_covid' => $rulesToArray,
            'precisou_ambulancia' => $rulesToBoolean,
            'precisou_internacao' => $rulesToBoolean,
            'quant_ida_servico' => $rulesToInteger,
            'tempo_internacao' => $rulesToInteger,
            'precisou_servico_outro' => $rulesToString,
            'recebeu_med_covid_outro' => $rulesToString,
            'nome_medicamento' => $rulesToString,
            'descreva_problema' => $rulesToString,
            'nome_hospital' => $rulesToString,
        ];
    }
}
