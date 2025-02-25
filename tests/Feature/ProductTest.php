<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_registro_correctamente()
    {
        $unit = \App\Models\Unit::factory()->create();
        $category = \App\Models\Category::factory()->create();
        $place = \App\Models\Place::factory()->create();
        $status = \App\Models\ProductStatus::factory()->create();

        $response = $this->postJson('/api/products', [
            'name' => 'Producto 1',
            'description' => 'Descripción del producto',
            'unit_id' => $unit->id,
            'price' => 100.50,
            'category_id' => $category->id,
            'place_id' => $place->id,
            'status_id' => $status->id,
            'observation' => 'Observación',
            'image' => 'images/products/product1.jpg',
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Producto 1');
    }


    public function test_crear_registro_con_datos_invalidos()
    {
        $response = $this->postJson('/api/products', [
            'name' => '',
            'price' => 'invalid',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price']);
    }

    public function test_obtener_lista_de_registros()
    {
        Product::factory()->count(2)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_actualizar_registro()
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Producto Modificado',
            'price' => 150.75,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Producto Modificado');
    }

    public function test_actualizar_registro_fallido_por_validacion()
    {
        $product = Product::factory()->create();

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => '',
            'price' => 'not-a-number',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'price']);
    }

    public function test_soft_delete_registro()
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    public function test_obtener_registros_eliminados()
    {
        $product = Product::factory()->create();
        $product->delete();

        $response = $this->getJson('/api/productsOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_registro()
    {
        $product = Product::factory()->create();
        $product->delete();

        $response = $this->patchJson("/api/products/{$product->id}/restore");

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'deleted_at' => null]);
    }

    public function test_eliminar_registro_permanentemente()
    {
        $product = Product::factory()->create();
        $product->delete();

        $response = $this->deleteJson("/api/products/{$product->id}/forceDelete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
