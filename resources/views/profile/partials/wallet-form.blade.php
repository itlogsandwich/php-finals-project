<section style="
    background-color: #fcfcf5; /* Light cream/beige background to match the main content area */
    border: 1px solid #d3d3c8; /* Subtle border for separation */
    padding: 20px;
    margin-top: 20px;
">
    <header>
        <h3 style="
            color: #384d38; /* Dark Green from the header/nav bar */
            text-transform: uppercase;
            font-size: 1.1rem; /* Slightly larger title */
            padding-bottom: 5px;
            border-bottom: 1px solid #5a7a5a; /* Separator line */
            margin-bottom: 15px;
        ">
            {{ __('Wallet Details') }}
        </h3>

        <h4 style="
            color: #444;
            font-size: 0.9rem;
            margin-bottom: 5px;
            font-family: monospace; /* Monospace font for keys adds a technical feel */
        ">
            {{ __("Public Key: " . $pubkey) }}
        </h4>

        <h4 style="
            color: #444;
            font-size: 0.9rem;
            margin-bottom: 15px;
            font-family: monospace;
        ">
            {{ __("Private Key: " . $privkey) }}
        </h4>
    </header>

    <form method="post" action="{{ route('profile.wallet' ) }}" class="mt-4 space-y-4">
        @csrf
        <div style="margin-bottom: 15px;">
            <x-input-label for="wallet" :value="__('WALLET (Current Balance)')" style="
                font-weight: bold; 
                color: #384d38; /* Dark green for label */
                display: block; 
                margin-bottom: 8px;
                font-size: 0.85rem;
            " />
            
            <x-text-input id="wallet" name="wallet" type="number" 
                style="
                    /* Classic Input Style */
                    background-color: #fefefe;
                    border: 1px solid #888;
                    padding: 8px 10px;
                    font-size: 1rem;
                    color: #222;
                    width: 100%;
                    box-sizing: border-box;
                    font-family: monospace; /* Monospace for financial data */
                "
                class="mt-1 block w-full" 
                :value="old('wallet', $user->wallet)" 
                required autofocus 
                autocomplete="wallet" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('wallet')" style="color: #a00; font-size: 0.8rem;" />
        </div>

        <div class="flex items-center gap-4 pt-3">
            <x-primary-button style="
                /* Classic Button Style */
                background-color: #5a7a5a; /* Medium Green */
                color: white;
                border: 1px solid #384d38;
                padding: 8px 15px;
                cursor: pointer;
                text-transform: uppercase;
                font-size: 0.9rem;
                font-weight: bold;
                transition: background-color 0.2s;
            ">
                {{ __('SAVE CHANGES') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="color: #486b40; font-weight: bold; font-size: 0.9rem;"
                >{{ __('Saved successfully.') }}</p>
            @endif
        </div>
    </form>
</section>