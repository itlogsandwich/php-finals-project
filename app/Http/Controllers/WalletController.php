<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    public function deposit(Request $request)
    {
        $validated = $request->validate([
            'wallet' => 'required|numeric|min: 0.000001',
        ]);

        $amount = $validated['wallet'];
        $user = auth()->user();

        $wallet = $user->wallet()->firstOrCreate(
            [],
            [
                'public_key' => Str::uuid(),
                'private_key' => bin2hex(random_bytes(32)),
                'balance' => 0,
            ]
        );

        $wallet->increment('balance', $amount);

        return redirect()->route('profile.edit')->with('status', 'Deposit Successful!');
    }
}
