<?php

namespace App\Actions;

use App\Models\Vacina;

class UpdateVacina
{
    public static function update(Vacina $vacina, $dataForm = [])
    {
        if ($dataForm['doses'] == 1) {
            $dataForm = array_merge($dataForm, ['intervalo_inicial_proxima_dose' => null, 'intervalo_final_proxima_dose' => null]);
        }


        if ($dataForm['doses'] != $vacina->doses) {
            $new_vacina = $vacina->replicate()->fill(
                array_merge($dataForm, ['is_active' => true])
            );

            $new_vacina->save();

            $vacina->is_active = false;
            $vacina->save();
            $vacina->delete();

            return $new_vacina;
        } else {
            $vacina->update($dataForm);
        }

        return $vacina;
    }
}
