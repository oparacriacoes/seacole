<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserSaudeUpdateRequest extends FormRequest
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
        $model = null;

        if ($this->agente) {
            $model = $this->agente;
        } elseif ($this->medico) {
            $model = $this->medico;
        } elseif ($this->psicologo) {
            $model = $this->psicologo;
        }

        return [
            'name' => ['string',' required', 'max:190'],
            'email' => 'unique:users,email,'.$model->user->id,
            'fone_celular_1' => BaseRules::STRING,
            'fone_celular_2' => BaseRules::STRING,
            'password' => ['nullable', 'string', 'required_with:password_confirmation','confirmed', 'min:6'],
        ];
    }
}
