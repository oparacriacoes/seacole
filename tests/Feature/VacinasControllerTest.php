<?php

namespace Tests\Feature;

use App\Models\Vacina;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VacinasControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_should_be_list_all_vacinas()
    {
        $user = User::factory(['role' => 'administrador'])->create();
        Vacina::factory()->count(5)->create();

        $response = $this->actingAs($user)->get(route('vacinas.index'));
        $data = $response->getOriginalContent()->getData();

        $response->assertOk();
        $this->assertEquals(5, count($data['vacinas']));
    }
}
