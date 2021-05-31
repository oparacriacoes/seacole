<?php

namespace Database\Factories;

use App\Models\Vacina;
use App\Models\Vacinacao;
use App\Models\Paciente;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacinacaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacinacao::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'data_vacinacao' => $this->faker->date('Y-m-d', 'now'),
            'dose' => 1,
            'reforco' => $this->faker->boolean(80),
            'vacina_id' => Vacina::factory(),
            'paciente_id' => Paciente::factory(),
        ];
    }
}
