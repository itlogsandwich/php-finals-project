<x-layouts.main>
    <style>
        /* Reverting to Phantom Route Marketplace Aesthetic */
        body {
            /* Light beige background as seen in images */
            background-color: #e8e8e3; 
        }
        .market-container {
            /* Light cream background for content blocks */
            background-color: #fcfcf5; 
            border: 1px solid #d3d3c8;
            padding: 25px;
            margin-bottom: 20px;
        }
        .market-heading {
            color: #384d38; /* Dark Green for main titles */
            text-transform: uppercase;
            font-size: 1.1rem;
            padding-bottom: 5px;
            border-bottom: 1px solid #5a7a5a; /* Separator line */
            margin-bottom: 15px;
        }
        .market-button-primary {
            /* Primary Button Style - Dark Green */
            background-color: #5a7a5a; 
            color: white;
            border: 1px solid #384d38;
            padding: 8px 15px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 0.9rem;
            font-weight: bold;
            display: inline-block;
        }
        .market-subtext {
            color: #444; 
            font-size: 0.9rem;
        }
    </style>

    <x-slot name="header">
        {{-- Header slot left intentionally blank or styled subtly to match the top bar in the image --}}
    </x-slot>

    <div class="py-12" style="padding-top: 40px;">
        {{-- Changed max-w-7xl to a fixed width container for a classic constrained feel --}}
        <div style="max-width: 650px; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem; space-y: 6;">
            
            <div class="market-container">
                <div class="max-w-xl" style="max-width: 100%;">
                    <h3 class="market-heading">
                        {{ __('ACCOUNT DETAILS') }}
                    </h3> 
                    <p class="market-subtext" style="margin-bottom: 15px;">
                        {{ __('Review and update your alias and contact information.') }}
                    </p>
                    
                    <x-primary-button id="editBtn" type="button" class="market-button-primary" style="margin-top: 10px;">
                        Edit Account
                    </x-primary-button>

                    <div id="editForm" style="display: none;" class="mt-3">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
            
            <div class="market-container">
                <div class="max-w-xl" style="max-width: 100%;">
                    @include('profile.partials.wallet-form')
                </div>
            </div>
            
            <div class="market-container">
                <div class="max-w-xl" style="max-width: 100%;">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="market-container" style="border: 2px solid #cc0000; background-color: #fef0f0;">
                <div class="max-w-xl" style="max-width: 100%;">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <script>
                document.getElementById('editBtn').addEventListener('click', function () {
                    const editForm = document.getElementById('editForm');
                    editForm.style.display = (editForm.style.display === 'none') ? 'block' : 'none';
                    // The button hides itself after click, as per the original logic
                    this.style.display = 'none'; 
                });
            </script>
        </div>
    </div>
</x-layouts.main>