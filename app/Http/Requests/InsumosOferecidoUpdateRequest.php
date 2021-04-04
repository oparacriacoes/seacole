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
        return [
            'condicao_ficar_isolada' => 'string',
            'tem_comida' => 'string',
            'tem_alguem' => 'string',
            'tarefas_autocuidado' => 'string',
            'precisa_tipo_ajuda' => 'array',
            'tratamento_prescrito' => 'string',
            'tratamento_financiado' => 'array',
            'material_entregue' => 'array',
            'oximetro_devolvido' => 'string',
        ];
    }
}
