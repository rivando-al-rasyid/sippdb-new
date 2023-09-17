<?php

namespace Tests\Feature\TUS\Auth;

use App\Modules\TUS\Models\TU;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/tu/register');

        $response->assertStatus(200);
    }

    public function test_new_t_us_can_register(): void
    {
        $response = $this->post('/tu/register', [
            'name' => 'Test TU',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticatedAs(TU::first(), 'tu');
        $response->assertRedirect('/tu');
    }
}
