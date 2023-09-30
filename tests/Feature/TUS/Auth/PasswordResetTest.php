<?php

namespace Tests\Feature\Tus\Auth;

use App\Modules\Tus\Models\Tu;
use App\Modules\Tus\Notifications\Auth\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use RefreshDatabase;

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/tu/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $tu = Tu::factory()->create();

        $this->post('/tu/forgot-password', ['email' => $tu->email]);

        Notification::assertSentTo($tu, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $tu = Tu::factory()->create();

        $this->post('/tu/forgot-password', ['email' => $tu->email]);

        Notification::assertSentTo($tu, ResetPassword::class, function ($notification) {
            $response = $this->get('/tu/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $tu = Tu::factory()->create();

        $this->post('/tu/forgot-password', ['email' => $tu->email]);

        Notification::assertSentTo($tu, ResetPassword::class, function ($notification) use ($tu) {
            $response = $this->post('/tu/reset-password', [
                'token' => $notification->token,
                'email' => $tu->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response->assertSessionHasNoErrors();

            return true;
        });
    }
}
