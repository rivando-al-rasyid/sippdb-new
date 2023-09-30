<?php

namespace Tests\Feature\Tus\Auth;

use App\Modules\Tus\Models\Tu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
            ->from('/tu/profile')
            ->put('/tu/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu/profile');

        $this->assertTrue(Hash::check('new-password', $tu->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
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
