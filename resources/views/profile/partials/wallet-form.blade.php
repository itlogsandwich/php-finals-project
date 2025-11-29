<section>
    <header>
        <h3 class="text-dark-web text-lg" style="color: #666; text-transform: uppercase;">
            {{ __('Wallet Details') }}
        </h3>

        <h4 class="mt-1 classic-small-text" style="color: #666; font-size: 0.8rem; margin-bottom: 15px;">
            {{ __("Public Key: " . $pubkey) }}
        </h4>

        <h4 class="mt-1 classic-small-text" style="color: #666; font-size: 0.8rem; margin-bottom: 15px;">
            {{ __("Private Key: " . $privkey) }}
        </h4>
    </header>

    <form method="post" action="{{ route('profile.wallet' ) }}" class="mt-4 space-y-4">
        @csrf
        <div style="margin-bottom: 10px;">
            <x-input-label for="wallet" :value="__('WALLET')" style="font-weight: bold; color: #333; display: block; margin-bottom: 5px;" />
            <!-- The 'classic-input' class is applied via the x-text-input component -->
            <x-text-input id="wallet" name="wallet" type="number" class="mt-1 block w-full" :value="old('wallet', $user->wallet)" required autofocus autocomplete="wallet" />
            <x-input-error class="mt-2" :messages="$errors->get('wallet')" />
        </div>

        <div class="flex items-center gap-4 pt-3">
            <!-- The 'classic-button' class is applied via the x-primary-button component -->
            <x-primary-button>{{ __('SAVE CHANGES') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="classic-small-text" style="color: #486b40; font-weight: bold;"
                >{{ __('Saved successfully.') }}</p>
            @endif
        </div>
    </form>
</section>