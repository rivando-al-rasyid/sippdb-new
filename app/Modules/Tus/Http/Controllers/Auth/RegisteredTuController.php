<?php

namespace App\Modules\Tus\Http\Controllers\Auth;

use App\Modules\Tus\Http\Controllers\Controller;
use App\Modules\Tus\Models\Tu;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredTuController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('tu.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Tu::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tu = Tu::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($tu));

        Auth::guard('tu')->login($tu);

        return redirect('/tu');
    }
}
