<section>
    <header>
        <p class="mt-1 classic-small-text" style="color: #666; font-size: 0.8rem; margin-bottom: 15px;">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('patch')

        <div style="margin-bottom: 10px;">
            <x-input-label for="name" :value="__('USERNAME')" style="font-weight: bold; color: #333; display: block; margin-bottom: 5px;" />
            <!-- The 'classic-input' class is applied via the x-text-input component -->
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div style="margin-bottom: 10px;">
            <x-input-label for="email" :value="__('EMAIL ADDRESS')" style="font-weight: bold; color: #333; display: block; margin-bottom: 5px;" />
            <!-- The 'classic-input' class is applied via the x-text-input component -->
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="border: 1px dashed #cc0000; padding: 10px; margin-top: 10px;">
                    <p class="classic-small-text" style="color: #333;">
                        {{ __('Your email address is currently UNVERIFIED.') }}

                        <button form="send-verification" class="classic-status-link" style="text-decoration: underline; color: #0000cc; background: none; border: none; padding: 0; cursor: pointer;">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 classic-small-text" style="color: #006600; font-weight: bold;">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
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