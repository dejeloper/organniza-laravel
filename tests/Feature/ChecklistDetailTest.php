<?php

namespace Tests\Feature;

use App\Models\ChecklistDetail;
use App\Models\ChecklistHeader;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChecklistDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_registro_correctamente()
    {
        $response = $this->postJson('/api/checklistDetails', [
            'checklist_header_id' => ChecklistHeader::factory()->create()->id,
            'product_id' => Product::factory()->create()->id,
            'pantry_amount_product' => 10.5,
            'pantry_unit_id' => Unit::factory()->create()->id,
            'required_amount_product' => 5.2,
            'required_unit_id' => Unit::factory()->create()->id,
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.pantry_amount_product', 10.5);
    }

    public function test_crear_registro_con_datos_invalidos()
    {
        $response = $this->postJson('/api/checklistDetails', [
            'checklist_header_id' => null, // Debe ser un ID válido
            'product_id' => null, // Debe ser un ID válido
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['checklist_header_id', 'product_id']);
    }

    public function test_obtener_lista_de_registros()
    {
        ChecklistDetail::factory()->count(3)->create();

        $response = $this->getJson('/api/checklistDetails');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_actualizar_registro()
    {
        $checklistDetail = ChecklistDetail::factory()->create();

        $response = $this->putJson("/api/checklistDetails/{$checklistDetail->id}", [
            'pantry_amount_product' => 20.0,
            'required_amount_product' => 8.5,
            'enabled' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.pantry_amount_product', 20);
    }

    public function test_actualizar_registro_fallido_por_validacion()
    {
        $checklistDetail = ChecklistDetail::factory()->create();

        $response = $this->putJson("/api/checklistDetails/{$checklistDetail->id}", [
            'pantry_amount_product' => 'invalid', // Debe ser numérico
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('pantry_amount_product');
    }

    public function test_soft_delete_registro()
    {
        $checklistDetail = ChecklistDetail::factory()->create();

        $response = $this->deleteJson("/api/checklistDetails/{$checklistDetail->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Detalle del checklist eliminado correctamente']);

        $this->assertSoftDeleted('checklist_details', ['id' => $checklistDetail->id]);
    }

    public function test_obtener_registros_eliminados()
    {
        $checklistDetail = ChecklistDetail::factory()->create();
        $checklistDetail->delete();

        $response = $this->getJson('/api/checklistDetailsOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_registro()
    {
        $checklistDetail = ChecklistDetail::factory()->create();
        $checklistDetail->delete();

        $response = $this->patchJson("/api/checklistDetails/{$checklistDetail->id}/restore");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Detalle del checklist restaurado correctamente']);

        $this->assertDatabaseHas('checklist_details', ['id' => $checklistDetail->id, 'deleted_at' => null]);
    }

    public function test_eliminar_registro_permanentemente()
    {
        $checklistDetail = ChecklistDetail::factory()->create();
        $checklistDetail->delete();

        $response = $this->deleteJson("/api/checklistDetails/{$checklistDetail->id}/forceDelete");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Detalle del checklist eliminado permanentemente']);

        $this->assertDatabaseMissing('checklist_details', ['id' => $checklistDetail->id]);
    }
}
