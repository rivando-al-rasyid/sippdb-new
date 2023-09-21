<?php

namespace Tests\Feature\TUS\Auth;

use App\Modules\TUS\Models\TU;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $tU = TU::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($tU, 'tu')->get('/tu/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $tU = TU::factory()->create([
            'email_verified_at' => null,
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'tu.verification.verify',
            now()->addMinutes(60),
            ['id' => $tU->id, 'hash' => sha1($tU->email)]
        );

        $response = $this->actingAs($tU, 'tu')->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($tU->fresh()->hasVerifiedEmail());
        $response->assertRedirect('/tu'.'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $tU = TU::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'tu.verification.verify',
            now()->addMinutes(60),
            ['id' => $tU->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($tU, 'tu')->get($verificationUrl);

        $this->assertFalse($tU->fresh()->hasVerifiedEmail());
    }
}
