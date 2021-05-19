<?php

namespace Tests\Feature;

use App\Models\Vacina;
use App\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreateTestSamples;
use Tests\TestCase;

class VacinacaoControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = CreateTestSamples::createAdministradorUser();
    }

    public function test_should_be_add_vacinacao_one_dose()
    {
        $paciente = Paciente::factory()->create();
        $vacina = Vacina::factory()->create(['doses' => 1]);

        $payload = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(7),
        ];

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('vacinacoes', ['paciente_id' => $paciente->id, 'vacina_id' => $vacina->id, 'dose' => 1]);
    }

    public function test_should_be_add_vacinacao_two_dose()
    {
        $paciente = Paciente::factory()->create();
        $vacina = Vacina::factory()->create(['doses' => 2]);

        $payload_first_dose = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(14),
            'dose' => 1,
        ];

        $payload_second_dose = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(7),
            'dose' => 2,
        ];

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_first_dose);
        $response->assertSessionHasNoErrors();

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_second_dose);
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('vacinacoes', ['paciente_id' => $paciente->id, 'vacina_id' => $vacina->id, 'dose' => 1]);
        $this->assertDatabaseHas('vacinacoes', ['paciente_id' => $paciente->id, 'vacina_id' => $vacina->id, 'dose' => 2]);
    }

    public function test_should_cannot_add_other_vacina_before_finish_doses()
    {
        $paciente = Paciente::factory()->create();
        $vacina = Vacina::factory()->create(['doses' => 2]);
        $vacina_secondary = Vacina::factory()->create(['doses' => 2]);

        $payload_first_dose = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(14),
            'dose' => 1,
        ];

        $payload_second_dose = [
            'vacina_id' => $vacina_secondary->id,
            'data_vacinacao' => now()->subDays(7),
            'dose' => 2,
        ];

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_first_dose);
        $response->assertSessionHasNoErrors();

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_second_dose);
        $response->assertSessionHas('error');

        $this->assertEquals(1, $paciente->vacinacao()->count());
    }

    public function test_should_be_add_reforce_after_two_doses()
    {
        $paciente = Paciente::factory()->create();
        $vacina = Vacina::factory()->create(['doses' => 2]);

        $payload_first_dose = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(14),
            'dose' => 1,
        ];

        $payload_second_dose = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(7),
            'dose' => 2,
        ];

        $payload_reforco = [
            'vacina_id' => $vacina->id,
            'data_vacinacao' => now()->subDays(1),
            'dose' => 1,
            'reforco' => true
        ];

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_first_dose);
        $response->assertSessionHasNoErrors();

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_second_dose);
        $response->assertSessionHasNoErrors();

        $response = $this->actingAs($this->user)->post(route('paciente.vacinacao', $paciente), $payload_reforco);
        $response->assertSessionHasNoErrors();

        $this->assertEquals(3, $paciente->vacinacao()->count());

        $this->assertDatabaseHas('vacinacoes', ['paciente_id' => $paciente->id, 'vacina_id' => $vacina->id, 'dose' => 1, 'reforco' => 1]);
    }
}
