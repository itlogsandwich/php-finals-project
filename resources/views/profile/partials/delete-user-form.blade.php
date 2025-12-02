<section class="space-y-4" style="
    padding: 20px; 
    border: 2px solid #cc0000; /* Red border for high alert */
    background-color: #fcebeb; /* Very light red/pink background for warning */
    margin-top: 20px;
">
    <header>
        <h3 style="
            text-transform: uppercase; 
            color: #cc0000; /* Danger Red */
            font-size: 1.1rem;
            padding-bottom: 5px;
            border-bottom: 1px solid #cc0000; 
            margin-bottom: 15px;
        ">
            {{ __('ACCOUNT TERMINATION') }}
        </h3>

        <p style="color: #660000; font-size: 0.9rem; font-weight: bold;">
            {{ __('WARNING: Once your account is permanently deleted, all associated data and transactions will be lost. Please download any data you wish to retain before proceeding.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        style="
            /* Danger Button Style */
            background-color: #cc0000; /* Danger Red */
            color: white;
            border: 1px solid #990000;
            padding: 8px 15px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: bold;
            transition: background-color 0.2s;
            margin-top: 10px;
        "
    >{{ __('DELETE ACCOUNT PERMANENTLY') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="
            padding: 25px; 
            background-color: #fcfcf5; /* Light cream/beige modal background */
            border: 3px solid #cc0000; /* Strong red border for focus/danger */
            width: 100%;
            box-sizing: border-box;
        ">
            @csrf
            @method('delete')

            <h3 style="
                text-transform: uppercase; 
                color: #cc0000; 
                font-size: 1.2rem;
                border-bottom: 2px solid #cc0000; 
                padding-bottom: 5px;
                margin-bottom: 20px;
            ">
                {{ __('CONFIRM ACCOUNT DELETION') }}
            </h3>

            <p style="color: #333; font-size: 0.95rem; margin-bottom: 20px;">
                {{ __('This action is permanent and irreversible. You are about to permanently delete your account. Enter your password to confirm this termination.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    style="
                        /* Classic Input Style */
                        background-color: #fefefe;
                        border: 1px solid #888;
                        padding: 8px 10px;
                        font-size: 1rem;
                        color: #222;
                        width: 75%; /* Maintain original width for input */
                        box-sizing: border-box;
                    "
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Verification Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" style="color: #a00; font-size: 0.8rem;" />
            </div>

            <div class="mt-6 flex justify-end" style="padding-top: 15px;">
                <x-secondary-button x-on:click="$dispatch('close')" style="
                    background-color: #fcfcf5; /* Light background */
                    color: #5a7a5a; /* Dark green text */
                    border: 1px solid #5a7a5a;
                    padding: 8px 15px;
                    cursor: pointer;
                    text-transform: uppercase;
                    font-size: 0.9rem;
                    margin-right: 10px;
                    transition: background-color 0.2s;
                ">
                    {{ __('CANCEL') }}
                </x-secondary-button>

                <x-danger-button type="submit" style="
                    background-color: #cc0000; 
                    color: white;
                    border: 1px solid #990000;
                    padding: 8px 15px;
                    cursor: pointer;
                    text-transform: uppercase;
                    font-size: 0.9rem;
                    font-weight: bold;
                    transition: background-color 0.2s;
                ">
                    {{ __('CONFIRM DELETION') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>