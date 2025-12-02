<section style="
    background-color: #fcfcf5; /* Light cream/beige background to match the main content area */
    border: 1px solid #d3d3c8; /* Subtle border for separation */
    padding: 20px;
    margin-top: 20px;
">
    <header>
        <h3 style="
            color: #384d38; /* Dark Green for the main title/context */
            text-transform: uppercase;
            font-size: 1.1rem;
            padding-bottom: 5px;
            border-bottom: 1px solid #5a7a5a; /* Separator line */
            margin-bottom: 15px;
        ">
            {{ __('Account Profile') }}
        </h3>
        <p style="color: #444; font-size: 0.9rem; margin-bottom: 20px;">
            {{ __("Update your account's profile information and email address. Remember, anonymity relies on the use of non-identifiable details.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('patch')

        <div style="margin-bottom: 15px;">
            <x-input-label for="name" :value="__('USERNAME')" style="
                font-weight: bold; 
                color: #384d38; 
                display: block; 
                margin-bottom: 8px;
                font-size: 0.85rem;
            " />
            <x-text-input id="name" name="name" type="text" 
                style="
                    /* Classic Input Style */
                    background-color: #fefefe;
                    border: 1px solid #888;
                    padding: 8px 10px;
                    font-size: 1rem;
                    color: #222;
                    width: 100%;
                    box-sizing: border-box;
                "
                class="mt-1 block w-full" 
                :value="old('name', $user->name)" 
                required autofocus 
                autocomplete="name" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('name')" style="color: #a00; font-size: 0.8rem;" />
        </div>

        <div style="margin-bottom: 15px;">
            <x-input-label for="email" :value="__('EMAIL ADDRESS')" style="
                font-weight: bold; 
                color: #384d38; 
                display: block; 
                margin-bottom: 8px;
                font-size: 0.85rem;
            " />
            <x-text-input id="email" name="email" type="email" 
                style="
                    /* Classic Input Style */
                    background-color: #fefefe;
                    border: 1px solid #888;
                    padding: 8px 10px;
                    font-size: 1rem;
                    color: #222;
                    width: 100%;
                    box-sizing: border-box;
                "
                class="mt-1 block w-full" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" style="color: #a00; font-size: 0.8rem;" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="
                    border: 1px dashed #cc0000; 
                    padding: 10px; 
                    margin-top: 15px; 
                    background-color: #fff0f0; /* Light red background for warning */
                ">
                    <p style="color: #660000; font-weight: bold; font-size: 0.9rem;">
                        {{ __('WARNING: Your email address is currently UNVERIFIED.') }}

                        <button form="send-verification" style="
                            text-decoration: underline; 
                            color: #0000cc; 
                            background: none; 
                            border: none; 
                            padding: 0; 
                            cursor: pointer; 
                            font-size: 0.9rem;
                        ">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2" style="color: #006600; font-weight: bold; font-size: 0.9rem;">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
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