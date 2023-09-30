<?php

namespace Tests\Feature\Tus\Auth;

use App\Modules\Tus\Models\Tu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $tu = Tu::factory()->create();

        $response = $this->actingAs($tu, 'tu')->get('/tu/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $tu = Tu::factory()->create();

        $response = $this->actingAs($tu, 'tu')->post('/tu/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $tu = Tu::factory()->create();

        $response = $this->actingAs($tu, 'tu')->post('/tu/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
