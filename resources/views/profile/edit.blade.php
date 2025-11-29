<!-- NOTE: Using basic dark classes for the deepweb/terminal aesthetic. -->
<x-app-layout>
    <style>
        /* Darknet / Terminal Aesthetic */
        body {
            background-color: #111; /* Deep black background */
            font-family: monospace, Courier New, monospace; /* Monospace for terminal feel */
        }
        .deepweb-header {
            color: #00ff00; /* Neon green text */
            text-shadow: 0 0 5px #00ff00;
            border-bottom: 1px solid #333;
        }
        .deepweb-container {
            background-color: #000;
            border: 1px solid #222; /* Subtle dark border */
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.1); /* Subtle green glow */
            padding: 32px;
            margin-bottom: 16px;
        }
        /* Override standard Laravel component styles */
        .deepweb-text { color: #00ff00; }
        .deepweb-subtext { color: #888; }
    </style>

    <x-slot name="header">
        <h2 class="font-bold text-xl deepweb-header leading-tight px-4 sm:px-6 lg:px-8 py-4">
            {{ __('SYSTEM LOG: USER PROFILE INTERFACE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Update Profile Information Form -->
            <div class="deepweb-container">
                    <div class="max-w-xl">
                        <h3 class="text-dark-web text-lg" style="color: #666; text-transform: uppercase;">
                            {{ __('Account Details') }}
                        </h3> 
                        <x-primary-button id="editBtn" type="button" class="btn btn-primary">
                            Edit Account
                        </x-primary-button>

                        <div id="editForm" style="display: none;" class="mt-3">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
            </div>
            <!-- Update Wallet-->
            <div class="deepweb-container">
                <div class="max-w-xl">
                    @include('profile.partials.wallet-form')
                </div>
            </div>
            <!-- Update Password Form -->
            <div class="deepweb-container">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Form -->
            <div class="deepweb-container">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <script>
                    document.getElementById('editBtn').addEventListener('click', function () {
                        const editForm = document.getElementById('editForm');
                        editForm.style.display = (editForm.style.display === 'none') ? 'block' : 'none';
                        this.style.display = 'none';
                    });
            </script>
        </div>
    </div>
</x-app-layout>