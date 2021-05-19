<?php

namespace Tests\Feature;

use App\Models\Vacina;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\CreateTestSamples;
use Tests\TestCase;

class VacinasControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_should_be_list_all_vacinas()
    {
        $user = CreateTestSamples::createAdministradorUser();
        Vacina::factory()->count(5)->create();

        $response = $this->actingAs($user)->get(route('vacinas.index'));
        $data = $response->getOriginalContent()->getData();

        $response->assertOk();
        $this->assertEquals(5, count($data['vacinas']));
    }

    public function test_should_cannot_create_vacina_with_doses()
    {
        $user = CreateTestSamples::createAdministradorUser();

        $response = $this->actingAs($user)->post(route('vacinas.store'), [
            'name' => 'Vacina 1',
            'fabricante' => 'Fabricante da Vacina 1',
            'doses' => 0,
            'intervalo_inicial_proxima_dose' => now()->addDays(5),
            'intervalo_final_proxima_dose' => now()->addDays(10),
        ]);

        $response->assertSessionHasErrors([
            'doses'
        ]);
    }

    public function test_should_cannot_create_vacina_without_intervals_to_dose_bigger_then_two()
    {
        $user = CreateTestSamples::createAdministradorUser();

        $response = $this->actingAs($user)->post(route('vacinas.store'), [
            'name' => 'Vacina 1',
            'fabricante' => 'Fabricante da Vacina 1',
            'doses' => 2,
        ]);

        $response->assertSessionHasErrors([
            'intervalo_inicial_proxima_dose',
            'intervalo_final_proxima_dose'
        ]);
    }

    public function test_should_cannot_create_vacina_with_final_interval_lower_then_initial()
    {
        $user = CreateTestSamples::createAdministradorUser();

        $response = $this->actingAs($user)->post(route('vacinas.store'), [
            'name' => 'Vacina 1',
            'fabricante' => 'Fabricante da Vacina 1',
            'doses' => 2,
            'intervalo_inicial_proxima_dose' => 15,
            'intervalo_final_proxima_dose' => 10,
        ]);

        $response->assertSessionHasErrors([
            'intervalo_final_proxima_dose'
        ]);
    }

    public function test_should_create_vacinas_with_valid_inputs()
    {
        $user = CreateTestSamples::createAdministradorUser();

        $this->actingAs($user)->post(route('vacinas.store'), [
            'name' => 'Vacina 1',
            'fabricante' => 'Fabricante da Vacina 1',
            'doses' => 1,
        ]);

        $this->actingAs($user)->post(route('vacinas.store'), [
            'name' => 'Vacina 2',
            'fabricante' => 'Fabricante da Vacina 2',
            'doses' => 2,
            'intervalo_inicial_proxima_dose' => 5,
            'intervalo_final_proxima_dose' => 10,
        ]);

        $response = $this->actingAs($user)->get(route('vacinas.index'));
        $data = $response->getOriginalContent()->getData();

        $response->assertOk();
        $this->assertEquals(2, count($data['vacinas']));
    }

    public function test_should_be_create_new_row_with_update_diff_doses()
    {
        $user = CreateTestSamples::createAdministradorUser();

        $vacina = Vacina::factory()->create([
            'doses' => 2,
            'intervalo_inicial_proxima_dose' => 5,
            'intervalo_final_proxima_dose' => 10,
        ]);

        $payload_update = [
            'name' => $vacina->name . ' - Updated',
            'fabricante' => $vacina->fabricante,
            'doses' => 1,
        ];

        $response = $this->actingAs($user)->put(route('vacinas.update', $vacina), $payload_update);
        $response->assertSessionHasNoErrors();

        $vacina = Vacina::withTrashed()->find($vacina->id);
        $new_vacina = Vacina::where('reference_key', $vacina->reference_key)->first();

        $this->assertNotNull($vacina->deleted_at);
        $this->assertEquals($vacina->is_active, 0);
        $this->assertNotEquals($new_vacina->id, $vacina->id);
    }

    public function test_should_be_simple_update_to_same_doses()
    {
        $user = CreateTestSamples::createAdministradorUser();

        $vacina = Vacina::factory()->create([
            'doses' => 2,
            'intervalo_inicial_proxima_dose' => 5,
            'intervalo_final_proxima_dose' => 10,
        ]);

        $payload_update = [
            'name' => $vacina->name . ' - Updated',
            'doses' => 2,
            'intervalo_inicial_proxima_dose' => 5,
            'intervalo_final_proxima_dose' => 9,
        ];

        $response = $this->actingAs($user)->put(route('vacinas.update', $vacina), $payload_update);
        $response->assertSessionHasNoErrors();

        $vacina->refresh();

        $this->assertEquals($vacina->name, $payload_update['name']);
    }
}
