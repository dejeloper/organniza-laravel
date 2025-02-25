<?php

namespace Tests\Feature;

use App\Models\ChecklistHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChecklistHeaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_registro_correctamente()
    {

        $response = $this->postJson('/api/checklistHeaders',   [
            'year' => 2025,
            'month' => 4,
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.year', 2025);
    }

    public function test_crear_registro_con_datos_invalidos()
    {
        $response = $this->postJson('/api/checklistHeaders', [
            'year' => 'invalid', // ❌ Debe ser numérico
            'month' => 'invalid', // ❌ Debe ser un número entre 1 y 12
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('year');
    }

    public function test_obtener_lista_de_registros()
    {
        ChecklistHeader::factory()->count(3)->create();

        $response = $this->getJson('/api/checklistHeaders');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    public function test_actualizar_registro()
    {
        $checklistHeader = ChecklistHeader::factory()->create();

        $response = $this->putJson("/api/checklistHeaders/{$checklistHeader->id}", [
            'year' => 2024,
            'month' => 5,
            'enabled' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.year', 2024);
    }

    public function test_actualizar_registro_fallido_por_validacion()
    {
        $checklistHeader = ChecklistHeader::factory()->create();

        $response = $this->putJson("/api/checklistHeaders/{$checklistHeader->id}", [
            'year' => 'invalid', // ❌ Año inválido
            'month' => 'invalid', // ❌ Mes inválido
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('year');
    }

    public function test_soft_delete_registro()
    {
        $checklistHeader = ChecklistHeader::factory()->create();

        $response = $this->deleteJson("/api/checklistHeaders/{$checklistHeader->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Encabezado del checklist eliminado correctamente']);

        $this->assertSoftDeleted('checklist_headers', ['id' => $checklistHeader->id]);
    }

    public function test_obtener_registros_eliminados()
    {
        $checklistHeader = ChecklistHeader::factory()->create();
        $checklistHeader->delete();

        $response = $this->getJson('/api/checklistHeadersOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_registro()
    {
        $checklistHeader = ChecklistHeader::factory()->create();
        $checklistHeader->delete();

        $response = $this->patchJson("/api/checklistHeaders/{$checklistHeader->id}/restore");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Encabezado del checklist restaurado correctamente']);

        $this->assertDatabaseHas('checklist_headers', ['id' => $checklistHeader->id, 'deleted_at' => null]);
    }

    public function test_eliminar_registro_permanentemente()
    {
        $checklistHeader = ChecklistHeader::factory()->create();
        $checklistHeader->delete();

        $response = $this->deleteJson("/api/checklistHeaders/{$checklistHeader->id}/forceDelete");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Encabezado del checklist eliminado permanentemente']);

        $this->assertDatabaseMissing('checklist_headers', ['id' => $checklistHeader->id]);
    }
}
