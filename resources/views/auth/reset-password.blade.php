<x-layouts.main>
    <div class="container" style="max-width: 450px; margin-top: 50px;">

        <div class="card rounded-0 shadow-sm" style="border: 2px solid #3b5734;">
            <div class="card-header rounded-0" style="background-color: #486b40; color: #fff; text-align: center; padding: 15px;">
                <h1 style="font-family: 'Georgia', serif; font-size: 20px; font-weight: bold; margin: 0;">
                    Reset Account Password
                </h1>
            </div>
            
            <div class="card-body" style="background-color: #f5f5f0; padding: 30px;">
                
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: bold; color: #333;">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username"
                            class="form-control rounded-0" 
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('email')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div class="mt-4 mb-3">
                        <label for="password" class="form-label" style="font-weight: bold; color: #333;">{{ __('New Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" 
                            class="form-control rounded-0"
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('password')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4 mb-4">
                        <label for="password_confirmation" class="form-label" style="font-weight: bold; color: #333;">{{ __('Confirm New Password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" 
                            class="form-control rounded-0"
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('password_confirmation')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn rounded-0" 
                            style="background-color: #cc0000; color: white; border: 1px solid #990000; font-weight: bold; padding: 8px 25px;">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</x-layouts.main>