<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $hashed = hash('sha256', $request->input('email'));
        $user = User::where('email', $hashed)->first();

        if ($user && Hash::check($request->input('password'), $user->password))
        {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard', absolute: false));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
