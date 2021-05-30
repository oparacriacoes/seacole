<?php

namespace Database\Factories;

use App\Models\Agente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'fone_celular_1' => $this->faker->phoneNumber,
            'fone_celular_2' => $this->faker->phoneNumber,
        ];
    }
}
