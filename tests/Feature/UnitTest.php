<?php

namespace Tests\Feature;

use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnitTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_unidad_correctamente()
    {
        $response = $this->postJson('/api/units', [
            'name' => 'Unidad 1',
            'short_name' => 'UN1',
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Unidad 1');
    }

    public function test_crear_unidad_con_datos_invalidos()
    {
        $response = $this->postJson('/api/units', [
            'name' => '',
            'short_name' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_obtener_lista_de_unidades()
    {
        Unit::factory()->count(3)->create();

        $response = $this->getJson('/api/units');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_actualizar_unidad()
    {
        $unit = Unit::factory()->create();

        $response = $this->putJson("/api/units/{$unit->id}", [
            'name' => 'Unidad Modificada',
            'short_name' => $unit->short_name,
            'enabled' => $unit->enabled,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Unidad Modificada');
    }

    public function test_actualizar_unidad_fallido_por_validacion()
    {
        $unit = Unit::factory()->create();

        $response = $this->putJson("/api/units/{$unit->id}", [
            'name' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_soft_delete_unidad()
    {
        $unit = Unit::factory()->create();

        $response = $this->deleteJson("/api/units/{$unit->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('units', ['id' => $unit->id]);
    }

    public function test_obtener_unidades_eliminadas()
    {
        Unit::factory()->count(2)->create();
        $deletedUnit = Unit::factory()->create();
        $deletedUnit->delete();

        $response = $this->getJson('/api/unitsOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_unidad()
    {
        $unit = Unit::factory()->create();
        $unit->delete();

        $response = $this->patchJson("/api/units/{$unit->id}/restore");

        $response->assertStatus(200);
        $this->assertDatabaseHas('units', ['id' => $unit->id, 'deleted_at' => null]);
    }

    public function test_eliminar_unidad_permanentemente()
    {
        $unit = Unit::factory()->create();
        $unit->delete();

        $response = $this->deleteJson("/api/units/{$unit->id}/forceDelete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('units', ['id' => $unit->id]);
    }
}
