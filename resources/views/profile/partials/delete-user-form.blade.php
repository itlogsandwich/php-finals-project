<section class="space-y-4" style="padding: 15px; border: 2px solid #cc0000; background-color: #ffe0e0;">
    <header>
        <h3 class="text-dark-web text-lg" style="text-transform: uppercase; color: #cc0000;">
            {{ __('ACCOUNT TERMINATION') }}
        </h3>

        <p class="mt-1 classic-small-text" style="color: #666; font-size: 0.8rem;">
            {{ __('WARNING: Once your account is permanently deleted, all associated data and transactions will be lost. Please download any data you wish to retain before proceeding.') }}
        </p>
    </header>

    <!-- Trigger Button -->
    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="classic-danger-button"
    >{{ __('DELETE ACCOUNT PERMANENTLY') }}</x-danger-button>

    <!-- Confirmation Modal (The styling for the x-modal component would need to be overridden/customized) -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 classic-modal-box">
            @csrf
            @method('delete')

            <h3 class="text-dark-web text-xl" style="text-transform: uppercase; color: #cc0000; border-bottom: 2px solid #cc0000; padding-bottom: 5px;">
                {{ __('CONFIRM ACCOUNT DELETION') }}
            </h3>

            <p class="mt-4 classic-small-text" style="color: #333; font-size: 0.9rem;">
                {{ __('This action is permanent and irreversible. You are about to permanently delete your account. Enter your password to confirm this termination.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <!-- Use classic input style for the password confirmation -->
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 classic-input"
                    placeholder="{{ __('Verification Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end classic-button-group">
                <!-- Cancel button with secondary classic styling -->
                <x-secondary-button x-on:click="$dispatch('close')" class="classic-secondary-button" style="margin-right: 10px;">
                    {{ __('CANCEL') }}
                </x-secondary-button>

                <!-- Confirm Delete button with danger classic styling -->
                <x-danger-button class="classic-danger-button" type="submit">
                    {{ __('CONFIRM DELETION') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>