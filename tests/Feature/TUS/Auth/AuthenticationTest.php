<?php

namespace Tests\Feature\TUS\Auth;

use App\Modules\TUS\Models\TU;
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

    public function test_t_us_can_authenticate_using_the_login_screen(): void
    {
        $tU = TU::factory()->create();

        $response = $this->post('/tu/login', [
            'email' => $tU->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($tU, 'tu');
        $response->assertRedirect('/tu');
    }

    public function test_t_us_can_not_authenticate_with_invalid_password(): void
    {
        $tU = TU::factory()->create();

        $this->post('/tu/login', [
            'email' => $tU->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('tu');
    }
}
