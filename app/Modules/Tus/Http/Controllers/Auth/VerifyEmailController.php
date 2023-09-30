<?php

namespace App\Modules\Tus\Http\Controllers\Auth;

use App\Modules\Tus\Http\Controllers\Controller;
use App\Modules\Tus\Http\Requests\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated tu's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('tu')->hasVerifiedEmail()) {
            return redirect()->intended('/tu?verified=1');
        }

        if ($request->user('tu')->markEmailAsVerified()) {
            event(new Verified($request->user('tu')));
        }

        return redirect()->intended('/tu?verified=1');
    }
}
