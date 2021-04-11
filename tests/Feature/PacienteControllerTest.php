<?php

namespace Tests\Feature;

use App\Agente;
use App\Http\Controllers\API\AgenteController;
use App\Paciente;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateTestSamples;
use Tests\TestCase;

class PacienteControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_agente_should_be_see_only_your_pacientes()
    {
        $totalPacientes = 5;
        $user = CreateTestSamples::createAgenteWithPacientes($totalPacientes);
        CreateTestSamples::createAgenteWithPacientes(3);

        $response = $this->actingAs($user)
            ->get(route('pacientes.index'));

        $response->assertOk();

        $data = $response->getOriginalContent()->getData();

        $this->assertEquals($totalPacientes, count($data['pacientes']));
    }

    public function test_psicologo_should_be_see_only_your_pacientes()
    {
        $totalPacientes = 5;
        $user = CreateTestSamples::createPsicologoWithPacientes($totalPacientes);
        CreateTestSamples::createPsicologoWithPacientes(3);

        $response = $this->actingAs($user)
            ->get(route('pacientes.index'));

        $response->assertOk();

        $data = $response->getOriginalContent()->getData();

        $this->assertEquals($totalPacientes, count($data['pacientes']));
    }

    public function test_medico_should_be_see_all_pacientes()
    {
        Paciente::factory()->count(5)->create();
        $user = CreateTestSamples::createMedicoWithPacientes(5);

        $response = $this->actingAs($user)
            ->get(route('pacientes.index'));

        $response->assertOk();

        $data = $response->getOriginalContent()->getData();

        $this->assertEquals(10, count($data['pacientes']));
    }

    public function test_admin_should_be_see_all_pacientes()
    {
        $user = User::factory(['role' => 'admin'])->create();
        Paciente::factory()->count(10)->create();

        $response = $this->actingAs($user)
            ->get(route('pacientes.index'));

        $response->assertOk();

        $data = $response->getOriginalContent()->getData();

        $this->assertEquals(10, count($data['pacientes']));
    }
}
