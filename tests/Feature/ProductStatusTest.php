<?php

namespace Tests\Feature;

use App\Models\ProductStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_registro_correctamente()
    {
        $response = $this->postJson('/api/productStatuses', [
            'name' => 'Activo',
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Activo');
    }

    public function test_crear_registro_con_datos_invalidos()
    {
        $response = $this->postJson('/api/productStatuses', [
            'name' => '', // Nombre vacío
            'enabled' => 'invalid', // Valor inválido para enabled
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'enabled']);
    }

    public function test_obtener_lista_de_registros()
    {
        ProductStatus::factory()->count(2)->create();

        $response = $this->getJson('/api/productStatuses');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_actualizar_registro()
    {
        $productStatus = ProductStatus::factory()->create();

        $response = $this->putJson("/api/productStatuses/{$productStatus->id}", [
            'name' => 'Inactivo',
            'enabled' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Inactivo');
    }

    public function test_actualizar_registro_fallido_por_validacion()
    {
        $productStatus = ProductStatus::factory()->create();

        $response = $this->putJson("/api/productStatuses/{$productStatus->id}", [
            'name' => '',
            'enabled' => 'not-a-boolean',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'enabled']);
    }

    public function test_soft_delete_registro()
    {
        $productStatus = ProductStatus::factory()->create();

        $response = $this->deleteJson("/api/productStatuses/{$productStatus->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('product_statuses', ['id' => $productStatus->id]);
    }

    public function test_obtener_registros_eliminados()
    {
        $productStatus = ProductStatus::factory()->create();
        $productStatus->delete();

        $response = $this->getJson('/api/productStatusesOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_registro()
    {
        $productStatus = ProductStatus::factory()->create();
        $productStatus->delete();

        $response = $this->patchJson("/api/productStatuses/{$productStatus->id}/restore");

        $response->assertStatus(200);
        $this->assertDatabaseHas('product_statuses', ['id' => $productStatus->id, 'deleted_at' => null]);
    }

    public function test_eliminar_registro_permanentemente()
    {
        $productStatus = ProductStatus::factory()->create();
        $productStatus->delete();

        $response = $this->deleteJson("/api/productStatuses/{$productStatus->id}/forceDelete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('product_statuses', ['id' => $productStatus->id]);
    }
}
