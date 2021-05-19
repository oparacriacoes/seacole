<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacinacaoRequest extends FormRequest
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
            'vacina_id' => ['numeric', 'required'],
            'data_vacinacao' => ['date', 'required'],
            'dose' => ['numeric'],
            'reforco' => BaseRules::BOOLEAN
        ];
    }
}
