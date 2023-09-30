<?php

namespace Tests\Feature\Tus\Auth;

use App\Modules\Tus\Models\Tu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/tu/login');

        $response->assertStatus(200);
    }

    public function test_tus_can_authenticate_using_the_login_screen(): void
    {
        $tu = Tu::factory()->create();

        $response = $this->post('/tu/login', [
            'email' => $tu->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($tu, 'tu');
        $response->assertRedirect('/tu');
    }

    public function test_tus_can_not_authenticate_with_invalid_password(): void
    {
        $tu = Tu::factory()->create();

        $this->post('/tu/login', [
            'email' => $tu->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('tu');
    }
}
