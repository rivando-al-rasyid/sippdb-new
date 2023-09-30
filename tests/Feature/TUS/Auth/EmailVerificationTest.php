<?php

namespace Tests\Feature\Tus\Auth;

use App\Modules\Tus\Models\Tu;
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
        $tu = Tu::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($tu, 'tu')->get('/tu/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $tu = Tu::factory()->create([
            'email_verified_at' => null,
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'tu.verification.verify',
            now()->addMinutes(60),
            ['id' => $tu->id, 'hash' => sha1($tu->email)]
        );

        $response = $this->actingAs($tu, 'tu')->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($tu->fresh()->hasVerifiedEmail());
        $response->assertRedirect('/tu'.'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $tu = Tu::factory()->create([
            'email_verified_at' => null,
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'tu.verification.verify',
            now()->addMinutes(60),
            ['id' => $tu->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($tu, 'tu')->get($verificationUrl);

        $this->assertFalse($tu->fresh()->hasVerifiedEmail());
    }
}
