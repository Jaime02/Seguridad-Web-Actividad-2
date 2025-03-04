<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserListingTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_users_list(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $guest = User::factory()->create(['role' => 'guest']);

        $response = $this->actingAs($admin)->get('/users');

        $response->assertStatus(200);
        $response->assertViewHas('users');
        $response->assertSee($guest->name);
        $response->assertSee($guest->email);
        $response->assertSee($guest->role);
    }

    public function test_guest_cannot_view_users_list(): void
    {
        $guest = User::factory()->create(['role' => 'guest']);

        $response = $this->actingAs($guest)->get('/users');

        $response->assertStatus(403);
        $response->assertSee('Only admins can access this page :(');
    }

    public function test_new_user_gets_guest_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'description' => 'Test description',
            'phone' => '+1234567890',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));

        $user = User::where('email', 'test@example.com')->first();
        $this->assertEquals('guest', $user->role);
    }
}
