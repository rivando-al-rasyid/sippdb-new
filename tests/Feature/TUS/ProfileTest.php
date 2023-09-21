<?php

namespace Tests\Feature\TUS;

use App\Modules\TUS\Models\TU;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_page_is_displayed(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->get('/tu/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->patch('/tu/profile', [
                'name' => 'Test TU',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu/profile');

        $tU->refresh();

        $this->assertSame('Test TU', $tU->name);
        $this->assertSame('test@example.com', $tU->email);
        $this->assertNull($tU->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->patch('/tu/profile', [
                'name' => 'Test TU',
                'email' => $tU->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu/profile');

        $this->assertNotNull($tU->refresh()->email_verified_at);
    }

    public function test_t_u_can_delete_their_account(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->delete('/tu/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/tu');

        $this->assertGuest('tu');
        $this->assertNull($tU->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $tU = TU::factory()->create();

        $response = $this
            ->actingAs($tU, 'tu')
            ->from('/tu/profile')
            ->delete('/tu/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/tu/profile');

        $this->assertNotNull($tU->fresh());
    }
}
