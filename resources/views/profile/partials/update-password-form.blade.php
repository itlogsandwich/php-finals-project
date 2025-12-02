<section style="
    background-color: #fcfcf5; /* Light cream/beige background to match the main content area */
    border: 1px solid #d3d3c8; /* Subtle border for separation */
    padding: 20px;
    margin-top: 20px;
">
    <header>
        <h3 style="
            color: #384d38; /* Dark Green for the main title */
            text-transform: uppercase;
            font-size: 1.1rem;
            padding-bottom: 5px;
            border-bottom: 1px solid #5a7a5a; /* Separator line */
            margin-bottom: 15px;
        ">
            {{ __('CHANGE PASSWORD') }}
        </h3>

        <p style="color: #444; font-size: 0.9rem; margin-bottom: 20px;">
            {{ __('Ensure your account is using a long, random password to stay secure. Use a password manager and strong OpSec.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('put')

        <div style="margin-bottom: 15px;">
            <x-input-label for="update_password_current_password" :value="__('CURRENT PASSWORD')" style="
                font-weight: bold; 
                color: #384d38; /* Dark green for label */
                display: block; 
                margin-bottom: 8px;
                font-size: 0.85rem;
            " />
            <x-text-input id="update_password_current_password" name="current_password" type="password" 
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
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" style="color: #a00; font-size: 0.8rem;" />
        </div>

        <div style="margin-bottom: 15px;">
            <x-input-label for="update_password_password" :value="__('NEW PASSWORD')" style="
                font-weight: bold; 
                color: #384d38; /* Dark green for label */
                display: block; 
                margin-bottom: 8px;
                font-size: 0.85rem;
            " />
            <x-text-input id="update_password_password" name="password" type="password" 
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
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" style="color: #a00; font-size: 0.8rem;" />
        </div>

        <div style="margin-bottom: 15px;">
            <x-input-label for="update_password_password_confirmation" :value="__('CONFIRM NEW PASSWORD')" style="
                font-weight: bold; 
                color: #384d38; /* Dark green for label */
                display: block; 
                margin-bottom: 8px;
                font-size: 0.85rem;
            " />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" 
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
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" style="color: #a00; font-size: 0.8rem;" />
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
                {{ __('SAVE NEW PASSWORD') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    style="color: #006600; font-weight: bold; font-size: 0.9rem;"
                >{{ __('Password successfully updated.') }}</p>
            @endif
        </div>
    </form>
</section>