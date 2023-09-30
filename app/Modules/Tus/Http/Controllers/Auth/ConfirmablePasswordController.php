<?php

namespace App\Modules\Tus\Http\Controllers\Auth;

use App\Modules\Tus\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('tu.auth.confirm-password');
    }

    /**
     * Confirm the tu's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('tu')->validate([
            'email' => $request->user('tu')->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('tu.auth.password_confirmed_at', time());

        return redirect()->intended('/tu');
    }
}
