<?php

namespace Tests\Feature\Tus\Auth;

use App\Modules\Tus\Models\Tu;
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

    public function test_new_tus_can_register(): void
    {
        $response = $this->post('/tu/register', [
            'name' => 'Test Tu',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticatedAs(Tu::first(), 'tu');
        $response->assertRedirect('/tu');
    }
}
