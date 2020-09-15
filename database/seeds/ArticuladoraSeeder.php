<?php

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
      DB::table('articuladoras')->insert([
          'name' => 'Débora',
      ]);

      DB::table('articuladoras')->insert([
          'name' => 'Luciana',
      ]);
    }
}
