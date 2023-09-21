<?php

namespace Tests\Feature\TUS\Auth;

use App\Modules\TUS\Models\TU;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $tU = TU::factory()->create();

        $response = $this->actingAs($tU, 'tu')->get('/tu/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $tU = TU::factory()->create();

        $response = $this->actingAs($tU, 'tu')->post('/tu/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $tU = TU::factory()->create();

        $response = $this->actingAs($tU, 'tu')->post('/tu/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
