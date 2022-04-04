<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;

    public function test_can_register_user()
    {
        $response = $this->post('/api/auth/register',[
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 'Pa$$w0rd',
        ]);

        $response->assertStatus(201);
        $response->assertJsonCount(5,'attributes');
        $this->assertNotNull($response->json('id'));
        $this->assertNotNull($response->json('type'));
        $this->assertNotNull($response->json('attributes'));
    }

    public function test_can_login_user()
    {
        User::factory()->create(['email' => 'omakei96@gmail.com']);
        $response = $this->post('/api/auth/login',[
            'email' => 'omakei96@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonCount(5,'attributes');
        $this->assertNotNull($response->json('id'));
        $this->assertNotNull($response->json('type'));
        $this->assertNotNull($response->json('attributes'));
        $this->assertNotNull($response->json('tokens'));
    }

    public function test_can_logout_user()
    {
        $user = User::factory()->create(['email' => 'omakei96@gmail.com']);

        $this->actingAs($user);

        $response = $this->post('/api/auth/logout');

        $response->assertStatus(204);
        $response->assertNoContent();
    }
}
