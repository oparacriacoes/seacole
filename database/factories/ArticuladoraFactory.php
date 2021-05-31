<?php

namespace Database\Factories;

use App\Models\Articuladora;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticuladoraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articuladora::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
