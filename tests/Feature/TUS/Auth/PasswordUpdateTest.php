<?php

namespace Tests\Feature\TUS\Auth;

use App\Modules\TUS\Models\TU;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->from('/tu/profile')
            ->put('/tu/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu/profile');

        $this->assertTrue(Hash::check('new-password', $tU->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->from('/tu/profile')
            ->put('/tu/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/tu/profile');
    }
}
