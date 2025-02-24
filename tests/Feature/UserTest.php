<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_crear_usuario_correctamente()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Usuario 1',
            'email' => 'user1@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201)
            ->assertJsonPath('data.name', 'Usuario 1');
    }

    public function test_crear_usuario_con_datos_invalidos()
    {
        $response = $this->postJson('/api/users', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => '123',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_obtener_lista_de_usuarios()
    {
        User::factory()->count(2)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    public function test_actualizar_usuario()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => 'Usuario Modificado',
            'email' => $user->email,
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('data.name', 'Usuario Modificado');
    }

    public function test_actualizar_usuario_fallido_por_validacion()
    {
        $user = User::factory()->create();

        $response = $this->putJson("/api/users/{$user->id}", [
            'name' => '',
            'email' => 'not-an-email',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_soft_delete_usuario()
    {
        $user = User::factory()->create();

        $response = $this->deleteJson("/api/users/{$user->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_obtener_usuarios_eliminados()
    {
        $user = User::factory()->create();
        $user->delete();

        $response = $this->getJson('/api/usersOnlyTrashed');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data');
    }

    public function test_restaurar_usuario()
    {
        $user = User::factory()->create();
        $user->delete();

        $response = $this->patchJson("/api/users/{$user->id}/restore");

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    public function test_eliminar_usuario_permanentemente()
    {
        $user = User::factory()->create();
        $user->delete();

        $response = $this->deleteJson("/api/users/{$user->id}/forceDelete");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
