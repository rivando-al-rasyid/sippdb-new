<?php

namespace App\Modules\Admins\Http\Controllers\Auth;

use App\Modules\Admins\Http\Controllers\Controller;
use App\Modules\Admins\Http\Requests\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated admin's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user('admin')->hasVerifiedEmail()) {
            return redirect()->intended('/admin?verified=1');
        }

        if ($request->user('admin')->markEmailAsVerified()) {
            event(new Verified($request->user('admin')));
        }

        return redirect()->intended('/admin?verified=1');
    }
}
