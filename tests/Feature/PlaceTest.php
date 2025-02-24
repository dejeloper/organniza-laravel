<?php

namespace Tests\Feature;

use App\Models\Place;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_lugar_correctamente()
    {
        $response = $this->postJson('/api/places', [
            'name' => 'Lugar 1',
            'short_name' => 'L1',
            'bg_color' => '#FFFFFF',
            'text_color' => '#000000',
            'enabled' => true,
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Lugar 1');
    }

    public function test_crear_lugar_con_datos_invalidos()
    {
        $response = $this->postJson('/api/places', [
            'name' => '',
            'short_name' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_obtener_lista_de_lugares()
    {
        Place::factory()->count(3)->create();

        $response = $this->getJson('/api/places');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'data');
    }

    public function test_actualizar_lugar()
    {
        $place = Place::factory()->create();

        $response = $this->putJson("/api/places/{$place->id}", [
            'name' => 'Lugar Modificado',
            'short_name' => $place->short_name,
            'bg_color' => $place->bg_color,
            'text_color' => $place->text_color,
            'enabled' => $place->enabled,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Lugar Modificado');
    }

    public function test_actualizar_lugar_fallido_por_validacion()
    {
        $place = Place::factory()->create();

        $response = $this->putJson("/api/places/{$place->id}", [
            'name' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_soft_delete_lugar()
    {
        $place = Place::factory()->create();

        $response = $this->deleteJson("/api/places/{$place->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('places', ['id' => $place->id]);
    }

    public function test_obtener_lugares_eliminados()
    {
        Place::factory()->count(2)->create();
        $deletedPlace = Place::factory()->create();
        $deletedPlace->delete();

        $response = $this->getJson('/api/placesOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_lugar()
    {
        $place = Place::factory()->create();
        $place->delete();

        $response = $this->patchJson("/api/places/{$place->id}/restore");

        $response->assertStatus(200);
        $this->assertDatabaseHas('places', ['id' => $place->id, 'deleted_at' => null]);
    }

    public function test_eliminar_lugar_permanentemente()
    {
        $place = Place::factory()->create();
        $place->delete();

        $response = $this->deleteJson("/api/places/{$place->id}/forceDelete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('places', ['id' => $place->id]);
    }
}
