<?php

namespace Database\Factories;

use App\Models\Vacina;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VacinaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacina::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $doses = random_int(1,2);
        $name = $this->faker->colorName();

        return [
            'name' => $name,
            'reference_key' => Str::of($name)->slug('_'),
            'fabricante' => $this->faker->company(),
            'doses' => $doses,
            'intervalo_inicial_proxima_dose' => $doses > 1 ? random_int(10, 15) : 0,
            'intervalo_final_proxima_dose' => $doses > 1 ? random_int(16, 21) : 0,
        ];
    }
}
