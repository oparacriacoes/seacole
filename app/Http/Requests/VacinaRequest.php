<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacinaRequest extends FormRequest
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
            'name' => ['string', 'required', 'max:190'],
            'fabricante' => BaseRules::STRING,
            'doses' => ['required', 'numeric', 'min:1', 'max:10'],
            'intervalo_inicial_proxima_dose' => ['required_unless:doses,<,1', 'numeric', 'min:1'],
            'intervalo_final_proxima_dose' => ['required_unless:doses,<,1', 'numeric', 'min:1', 'gt:intervalo_inicial_proxima_dose'],
        ];
    }
}
