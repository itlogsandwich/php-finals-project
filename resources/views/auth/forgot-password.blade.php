<x-layouts.main>
    <div class="container" style="max-width: 450px; margin-top: 50px;">

        <div class="card rounded-0 shadow-sm" style="border: 2px solid #3b5734;">
            <div class="card-header rounded-0" style="background-color: #486b40; color: #fff; text-align: center; padding: 15px;">
                <h1 style="font-family: 'Georgia', serif; font-size: 20px; font-weight: bold; margin: 0;">
                    Access Recovery
                </h1>
            </div>
            
            <div class="card-body" style="background-color: #f5f5f0; padding: 30px;">
                
                <div class="mb-4" style="font-size: 15px; color: #333; line-height: 1.6;">
                    {{ __('Forgot your access phrase? Enter the email associated with your account below. We will dispatch a secure reset link to that address.') }}
                </div>

                <!-- Session Status / Success or Error Message -->
                @if (session('status'))
                    <div class="mb-4 p-3 rounded-0" style="font-size: 14px; font-weight: bold; color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb;">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label" style="font-weight: bold; color: #333;">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-control rounded-0" 
                            style="border: 1px solid #c0c0c0; background-color: #fff; padding: 8px 10px;">
                        
                        @error('email')
                            <div class="text-danger mt-1" style="font-size: 0.8rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn rounded-0" 
                            style="background-color: #cc0000; color: white; border: 1px solid #990000; font-weight: bold; padding: 8px 25px;">
                            {{ __('Send Reset Link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</x-layouts.main>