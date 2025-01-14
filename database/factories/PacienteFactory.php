<?php

namespace Database\Factories;

use App\Models\Agente;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Psicologo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paciente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'data_nascimento' => $this->faker->date('Y-m-d', 'now'),
            'agente_id' => Agente::factory(),
            'medico_id' => Medico::factory(),
            'psicologo_id' => Psicologo::factory(),
        ];
    }
}
