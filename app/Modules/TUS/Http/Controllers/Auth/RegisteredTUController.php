<?php

namespace App\Modules\TUS\Http\Controllers\Auth;

use App\Modules\TUS\Http\Controllers\Controller;
use App\Modules\TUS\Models\TU;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredTUController extends Controller
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.TU::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $tU = TU::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($tU));

        Auth::guard('tu')->login($tU);

        return redirect('/tu');
    }
}
