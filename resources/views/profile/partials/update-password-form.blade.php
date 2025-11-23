<section>
    <header>
        <h3 class="text-dark-web text-lg" style="text-transform: uppercase;">
            {{ __('CHANGE PASSWORD') }}
        </h3>

        <p class="mt-1 classic-small-text" style="color: #666; font-size: 0.8rem; margin-bottom: 15px;">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4 space-y-4">
        @csrf
        @method('put')

        <div style="margin-bottom: 10px;">
            <x-input-label for="update_password_current_password" :value="__('CURRENT PASSWORD')" style="font-weight: bold; color: #333; display: block; margin-bottom: 5px;" />
            <!-- The 'classic-input' class is applied via the x-text-input component -->
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div style="margin-bottom: 10px;">
            <x-input-label for="update_password_password" :value="__('NEW PASSWORD')" style="font-weight: bold; color: #333; display: block; margin-bottom: 5px;" />
            <!-- The 'classic-input' class is applied via the x-text-input component -->
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div style="margin-bottom: 10px;">
            <x-input-label for="update_password_password_confirmation" :value="__('CONFIRM NEW PASSWORD')" style="font-weight: bold; color: #333; display: block; margin-bottom: 5px;" />
            <!-- The 'classic-input' class is applied via the x-text-input component -->
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-3">
            <!-- The 'classic-button' class is applied via the x-primary-button component -->
            <x-primary-button>{{ __('SAVE NEW PASSWORD') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="classic-small-text" style="color: #006600; font-weight: bold;"
                >{{ __('Password successfully updated.') }}</p>
            @endif
        </div>
    </form>
</section>