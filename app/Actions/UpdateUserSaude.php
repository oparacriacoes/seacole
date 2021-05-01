<?php

namespace App\Actions;

use App\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserSaude {

    public static function update($model, $dataForm = [])
    {
        $model->update([
            'fone_celular_1' => $dataForm['fone_celular_1'],
            'fone_celular_2' => $dataForm['fone_celular_2']
        ]);

        $model->user()->update([
            'name' => $dataForm['name'],
            'email' => $dataForm['email'],
        ]);

        if ($dataForm['password']) {
            $model->user()->update([
                'password' => Hash::make($dataForm['password']),
            ]);
        }

        return $model;
    }
}
