<?php

namespace Tests;

use App\Agente;
use App\Medico;
use App\Paciente;
use App\Psicologo;
use App\User;

class CreateTestSamples
{
    public static function createAgenteWithPacientes($totalPacientes = 0)
    {
        $user = User::factory(['role' => 'agente'])
            ->has(
                Agente::factory()
                    ->has(Paciente::factory()->count($totalPacientes))
            )
            ->create();

        return $user;
    }

    public static function createPsicologoWithPacientes($totalPacientes = 0)
    {
        $user = User::factory(['role' => 'psicologo'])
            ->has(
                Psicologo::factory()
                    ->has(Paciente::factory()->count($totalPacientes))
            )
            ->create();

        return $user;
    }

    public static function createMedicoWithPacientes($totalPacientes = 0)
    {
        $user = User::factory(['role' => 'medico'])
            ->has(
                Medico::factory()
                    ->has(Paciente::factory()->count($totalPacientes))
            )
            ->create();

        return $user;
    }
}
