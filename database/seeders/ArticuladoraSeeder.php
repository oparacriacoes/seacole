<?php

namespace Database\Seeders;

use App\Models\Articuladora;
use Illuminate\Database\Seeder;

class ArticuladoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Articuladora::factory()->create([
            'name' => 'Débora'
        ]);

        Articuladora::factory()->create([
            'name' => 'Luciana'
        ]);
    }
}
