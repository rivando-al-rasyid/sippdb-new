<?php

namespace App\Modules\Tus\Http\Controllers\Auth;

use App\Modules\Tus\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user('tu')->hasVerifiedEmail()
                    ? redirect()->intended('/tu')
                    : view('tu.auth.verify-email');
    }
}
