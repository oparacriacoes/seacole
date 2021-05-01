<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsumosOferecidoUpdateRequest extends FormRequest
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
        $booleanRules = ['nullable', 'boolean'];

        return [
            'condicao_ficar_isolada' => $booleanRules,
            'tem_comida' => $booleanRules,
            'tem_alguem' => $booleanRules,
            'tarefas_autocuidado' => $booleanRules,
            'tratamento_prescrito' => $booleanRules,
            'oximetro_devolvido' => $booleanRules,
            'precisa_tipo_ajuda' => 'array',
            'tratamento_financiado' => 'array',
            'material_entregue' => 'array',
        ];
    }
}
