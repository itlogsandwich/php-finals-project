<x-layouts.main>
    <div class="container" style="max-width: 450px; margin-top: 50px;">

        <div class="card rounded-0 shadow-sm" style="border: 2px solid #3b5734;">
            <div class="card-header rounded-0" style="background-color: #cc0000; color: #fff; text-align: center; padding: 15px;">
                <h1 style="font-family: 'Georgia', serif; font-size: 20px; font-weight: bold; margin: 0;">
                    Security Breach Detected
                </h1>
            </div>
            
            <div class="card-body" style="background-color: #f5f5f0; padding: 30px;">
                
                <div class="mb-4" style="font-size: 15px; color: #333; line-height: 1.6; font-weight: bold;">
                    {{ __('ACCESS DENIED: This is a secure area of the system. Re-authentication is mandatory before proceeding to sensitive data or actions.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-weight: bold; color: #333;">{{ __('Current Access Phrase (Password)') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="form-control rounded-0" 
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('password')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn rounded-0" 
                            style="background-color: #cc0000; color: white; border: 1px solid #990000; font-weight: bold; padding: 8px 25px;">
                            {{ __('Confirm Authorization') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</x-layouts.main>