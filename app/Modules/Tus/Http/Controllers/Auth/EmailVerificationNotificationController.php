<?php

namespace App\Modules\Tus\Http\Controllers\Auth;

use App\Modules\Tus\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user('tu')->hasVerifiedEmail()) {
            return redirect()->intended('/tu');
        }

        $request->user('tu')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
