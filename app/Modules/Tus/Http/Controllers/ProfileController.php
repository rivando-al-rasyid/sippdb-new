<?php

namespace App\Modules\Tus\Http\Controllers;

use App\Modules\Tus\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the tu's profile form.
     */
    public function edit(Request $request): View
    {
        return view('tu.profile.edit', [
            'user' => $request->user('tu'),
        ]);
    }

    /**
     * Update the tu's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user('tu')->fill($request->validated());

        if ($request->user('tu')->isDirty('email')) {
            $request->user('tu')->email_verified_at = null;
        }

        $request->user('tu')->save();

        return Redirect::route('tu.profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the tu's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password:tu'],
        ]);

        $tu = $request->user('tu');

        Auth::guard('tu')->logout();

        $tu->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/tu');
    }
}
