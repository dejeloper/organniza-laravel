<?php

namespace Tests\Feature;

use App\Models\PurchasesHistoryDetail;
use App\Models\PurchasesHistoryHeader;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchasesHistoryDetailTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_historial_compras_detalle_correctamente()
    {
        $header = PurchasesHistoryHeader::factory()->create();
        $product = Product::factory()->create();
        $unit = Unit::factory()->create();

        $response = $this->postJson('/api/purchasesHistoryDetails', [
            'purchases_history_header_id' => $header->id,
            'product_id' => $product->id,
            'amount_product' => 10,
            'unit_product' => $unit->id,
            'sub_total_product' => 500.75,
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.amount_product', 10);
    }

    public function test_crear_historial_compras_detalle_con_datos_invalidos()
    {
        $response = $this->postJson('/api/purchasesHistoryDetails', [
            'purchases_history_header_id' => null,
            'product_id' => null,
            'amount_product' => -5,
            'unit_product' => null,
            'sub_total_product' => -100,
            'enabled' => 'not_a_boolean',
        ]);

        $response->assertStatus(422);
    }

    public function test_obtener_lista_de_historiales_compras_detalle()
    {
        PurchasesHistoryDetail::factory()->count(3)->create();

        $response = $this->getJson('/api/purchasesHistoryDetails');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_actualizar_historial_compras_detalle()
    {
        $detail = PurchasesHistoryDetail::factory()->create();

        $response = $this->putJson("/api/purchasesHistoryDetails/{$detail->id}", [
            'amount_product' => 20,
            'sub_total_product' => 1000,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.amount_product', 20);
    }

    public function test_actualizar_historial_compras_detalle_fallido_por_validacion()
    {
        $detail = PurchasesHistoryDetail::factory()->create();

        $response = $this->putJson("/api/purchasesHistoryDetails/{$detail->id}", [
            'amount_product' => -10,
            'sub_total_product' => -500,
        ]);

        $response->assertStatus(422);
    }

    public function test_soft_delete_historial_compras_detalle()
    {
        $detail = PurchasesHistoryDetail::factory()->create();

        $response = $this->deleteJson("/api/purchasesHistoryDetails/{$detail->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('purchases_history_details', ['id' => $detail->id]);
    }

    public function test_obtener_historiales_compras_detalle_eliminados()
    {
        $detail = PurchasesHistoryDetail::factory()->create();
        $detail->delete();

        $response = $this->getJson('/api/purchasesHistoryDetailsOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_historial_compras_detalle()
    {
        $detail = PurchasesHistoryDetail::factory()->create();
        $detail->delete();

        $response = $this->patchJson("/api/purchasesHistoryDetails/{$detail->id}/restore");

        $response->assertStatus(200);
        $this->assertDatabaseHas('purchases_history_details', ['id' => $detail->id, 'deleted_at' => null]);
    }

    public function test_eliminar_historial_compras_detalle_permanentemente()
    {
        $detail = PurchasesHistoryDetail::factory()->create();
        $detail->delete();

        $response = $this->deleteJson("/api/purchasesHistoryDetails/{$detail->id}/forceDelete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('purchases_history_details', ['id' => $detail->id]);
    }
}
