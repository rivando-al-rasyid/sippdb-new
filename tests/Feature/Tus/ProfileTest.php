<?php

namespace Tests\Feature\Tus;

use App\Modules\Tus\Models\Tu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
            ->get('/tu/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
            ->patch('/tu/profile', [
                'name' => 'Test Tu',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu/profile');

        $tu->refresh();

        $this->assertSame('Test Tu', $tu->name);
        $this->assertSame('test@example.com', $tu->email);
        $this->assertNull($tu->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
            ->patch('/tu/profile', [
                'name' => 'Test Tu',
                'email' => $tu->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu/profile');

        $this->assertNotNull($tu->refresh()->email_verified_at);
    }

    public function test_tu_can_delete_their_account(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
            ->delete('/tu/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu');

        $this->assertGuest('tu');
        $this->assertNull($tu->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $tu = Tu::factory()->create();

        $response = $this
            ->actingAs($tu, 'tu')
            ->from('/tu/profile')
            ->delete('/tu/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/tu/profile');

        $this->assertNotNull($tu->fresh());
    }
}
