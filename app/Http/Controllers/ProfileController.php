<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.view', compact('users'));
    }

    public function userRemove($user_id)
    {
        $user = User::findOrFail($user_id);

        $user->delete();

        return back()->with('success message', 'User has been removed');
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $nonce = 'sus67';

        $pubkey = $nonce . hash('sha256', $request->user()->name);
        $privkey = $nonce . hash('sha256', $pubkey);

        return view('profile.edit', [
            'user' => $request->user(),
            'pubkey' => $pubkey,
            'privkey' => $privkey, 
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function cashIn(Request $request): RedirectResponse
    {
        $user = User::findOrFail(auth()->id());

        $balance = $request->input('wallet');

        $userWallet= [
            'wallet' => $balance,
        ];

        $user->update($userWallet);
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
