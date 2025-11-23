<x-layouts.main>
    <div class="container" style="max-width: 550px; margin-top: 50px;">

        <div class="card rounded-0 shadow-sm" style="border: 2px solid #3b5734;">
            <div class="card-header rounded-0" style="background-color: #486b40; color: #fff; text-align: center; padding: 15px;">
                <h1 style="font-family: 'Georgia', serif; font-size: 20px; font-weight: bold; margin: 0;">
                    Verification Required
                </h1>
            </div>
            
            <div class="card-body" style="background-color: #f5f5f0; padding: 30px;">
                
                <div class="mb-4" style="font-size: 15px; color: #333; line-height: 1.6;">
                    {{ __('Your account registration is almost complete. Please confirm your identity by clicking the verification link that was sent to your registered email address.') }}
                    <br><br>
                    {{ __('If you did not receive the verification email, or if the link has expired, you may request a new one below.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-3 rounded-0" style="font-size: 14px; font-weight: bold; color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb;">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="mt-4 d-flex justify-content-between align-items-center">
                    
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <button type="submit" class="btn rounded-0" 
                            style="background-color: #486b40; color: white; border: 1px solid #3b5734; font-weight: bold; padding: 8px 15px; font-size: 14px;">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="btn btn-link p-0" 
                            style="color: #cc0000; font-size: 14px; text-decoration: underline;">
                            {{ __('Log Out (Exit Portal)') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</x-layouts.main>