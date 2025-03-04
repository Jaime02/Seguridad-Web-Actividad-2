<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_login_and_receive_a_token()
    {
        // Create a user
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        // Attempt to login
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        // Assert the response is successful
        $response->assertStatus(200);

        // Assert the token is created
        $this->assertNotNull($user->tokens()->first());
    }

    public function it_cannot_access_protected_route_without_token()
    {
        // Attempt to access a protected route
        $response = $this->getJson('/api/checktoken');

        // Assert the response
        $response->assertStatus(401);
        $response->assertJson([
            'message' => 'Unauthorized.',
        ]);
    }

    public function it_can_access_protected_route_with_token()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a token for the user
        $token = $user->createToken('auth-token')->plainTextToken;

        // Attempt to access a protected route with the token
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/checktoken');

        // Assert the response is successful
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Token is valid',
        ]);
    }
}
