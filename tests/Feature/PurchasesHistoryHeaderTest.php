<?php

namespace Tests\Feature;

use App\Models\PurchasesHistoryHeader;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchasesHistoryHeaderTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_registro_correctamente()
    {
        $response = $this->postJson('/api/purchasesHistoryHeaders', [
            'year' => 2024,
            'month' => 2,
            'amount_purchase' => 1500.50,
            'total_purchase' => 3000.75,
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.year', 2024);
    }

    public function test_crear_registro_con_datos_invalidos()
    {
        $response = $this->postJson('/api/purchasesHistoryHeaders', [
            'year' => 'invalid', // Debe ser numérico
            'month' => 'invalid', // Debe ser numérico
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['year', 'month']);
    }

    public function test_obtener_lista_de_registros()
    {
        PurchasesHistoryHeader::factory()->count(3)->create();

        $response = $this->getJson('/api/purchasesHistoryHeaders');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_actualizar_registro()
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::factory()->create();

        $response = $this->putJson("/api/purchasesHistoryHeaders/{$purchasesHistoryHeader->id}", [
            'amount_purchase' => 5000.00,
            'total_purchase' => 10000.00,
            'enabled' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.amount_purchase', 5000);
    }

    public function test_actualizar_registro_fallido_por_validacion()
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::factory()->create();

        $response = $this->putJson("/api/purchasesHistoryHeaders/{$purchasesHistoryHeader->id}", [
            'total_purchase' => 'invalid', // Debe ser numérico
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('total_purchase');
    }

    public function test_soft_delete_registro()
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::factory()->create();

        $response = $this->deleteJson("/api/purchasesHistoryHeaders/{$purchasesHistoryHeader->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Encabezado de compras eliminado correctamente']);

        $this->assertSoftDeleted('purchases_history_headers', ['id' => $purchasesHistoryHeader->id]);
    }

    public function test_obtener_registros_eliminados()
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::factory()->create();
        $purchasesHistoryHeader->delete();

        $response = $this->getJson('/api/purchasesHistoryHeadersOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_registro()
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::factory()->create();
        $purchasesHistoryHeader->delete();

        $response = $this->patchJson("/api/purchasesHistoryHeaders/{$purchasesHistoryHeader->id}/restore");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Encabezado de compras restaurado correctamente']);

        $this->assertDatabaseHas('purchases_history_headers', ['id' => $purchasesHistoryHeader->id, 'deleted_at' => null]);
    }

    public function test_eliminar_registro_permanentemente()
    {
        $purchasesHistoryHeader = PurchasesHistoryHeader::factory()->create();
        $purchasesHistoryHeader->delete();

        $response = $this->deleteJson("/api/purchasesHistoryHeaders/{$purchasesHistoryHeader->id}/forceDelete");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Encabezado de compras eliminado permanentemente']);

        $this->assertDatabaseMissing('purchases_history_headers', ['id' => $purchasesHistoryHeader->id]);
    }
}
