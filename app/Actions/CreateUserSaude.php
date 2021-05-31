<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserSaude {

    public static function create($model, $dataForm = [], $role)
    {
        $user = new User([
            'name' => $dataForm['name'],
            'email' => $dataForm['email'],
            'role' => $role,
            'password' => Hash::make('seacole2021'),
        ]);

        $user->save();

        $model::create([
            'fone_celular_1' => $dataForm['fone_celular_1'],
            'fone_celular_2' => $dataForm['fone_celular_2'],
            'user_id' => $user->id,
        ]);

        return $user;
    }
}
