<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSaudeStoreRequest extends FormRequest
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
            'name' => ['string',' required', 'max:190'],
            'email' => ['email', 'unique:users', 'max:190', 'required'],
            'fone_celular_1' => BaseRules::STRING,
            'fone_celular_2' => BaseRules::STRING,
        ];
    }
}
