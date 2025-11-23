<x-layouts.main>
    <div class="container" style="max-width: 450px; margin-top: 50px;">

        <div class="card rounded-0 shadow-sm" style="border: 2px solid #3b5734;">
            <div class="card-header rounded-0" style="background-color: #486b40; color: #fff; text-align: center; padding: 15px;">
                <h1 style="font-family: 'Georgia', serif; font-size: 20px; font-weight: bold; margin: 0;">
                    Vendor & User Access
                </h1>
            </div>
            
            <div class="card-body" style="background-color: #f5f5f0; padding: 30px;">
                
                {{-- Session Status (Stylized Message) --}}
                @if (session('status'))
                    <div class="alert alert-success rounded-0" role="alert" style="border: 1px solid #486b40; background-color: #e6ffe6; color: #3b5734;">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Username/Email Address --}}
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: bold; color: #333;">{{ __('Username/Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="form-control rounded-0" 
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('email')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label" style="font-weight: bold; color: #333;">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="form-control rounded-0"
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('password')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="form-check mb-4">
                        <input class="form-check-input rounded-0" type="checkbox" name="remember" id="remember_me" style="border: 1px solid #888;">
                        <label class="form-check-label" for="remember_me" style="font-size: 14px; color: #555;">
                            {{ __('Remember me (24h)') }}
                        </label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        
                        @if (Route::has('password.request'))
                            <a class="btn btn-link p-0" href="{{ route('password.request') }}" style="color: #486b40; font-size: 14px; text-decoration: underline;">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif

                        <button type="submit" class="btn rounded-0" 
                            style="background-color: #cc0000; color: white; border: 1px solid #990000; font-weight: bold; padding: 8px 25px;">
                            {{ __('Log in') }}
                        </button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <p style="font-size: 13px; color: #777;">
                            New here? <a href="{{ route('register') }}" style="color: #486b40; text-decoration: underline;">Register an account</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</x-layouts.main>