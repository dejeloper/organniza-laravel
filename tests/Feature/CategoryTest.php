<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_categoria_correctamente()
    {
        $response = $this->postJson('/api/categories', [
            'name' => 'Categoría 1',
            'icon' => 'icon.png',
            'bg_color' => '#FFFFFF',
            'text_color' => '#000000',
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Categoría 1');
    }

    public function test_crear_categoria_con_datos_invalidos()
    {
        $response = $this->postJson('/api/categories', [
            'name' => '', // Falta el nombre
            'icon' => 'icon.png',
            'bg_color' => '#FFFFFF',
            'text_color' => '#000000',
            'enabled' => true,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_obtener_lista_de_categorias()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_actualizar_categoria()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/categories/{$category->id}", [
            'name' => 'Categoría Modificada',
            'icon' => 'icon_new.png',
            'bg_color' => '#CCCCCC',
            'text_color' => '#111111',
            'enabled' => false,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Categoría Modificada');
    }

    public function test_actualizar_categoria_fallido_por_validacion()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/api/categories/{$category->id}", [
            'name' => '', // Nombre vacío, debe fallar
            'icon' => 'icon.png',
            'bg_color' => '#FFFFFF',
            'text_color' => '#000000',
            'enabled' => true,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('name');
    }

    public function test_soft_delete_categoria()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Categoría eliminada correctamente']);

        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_obtener_categorias_eliminadas()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->getJson('/api/categoriesOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_categoria()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->patchJson("/api/categories/{$category->id}/restore");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Categoría restaurada correctamente']);

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'deleted_at' => null]);
    }

    public function test_eliminar_categoria_permanentemente()
    {
        $category = Category::factory()->create();
        $category->delete();

        $response = $this->deleteJson("/api/categories/{$category->id}/forceDelete");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Categoría eliminada permanentemente']);

        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
