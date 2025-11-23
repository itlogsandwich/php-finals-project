<x-layouts.main>
    
    <div class="container" style="max-width: 900px; margin-top: 30px;">
        
        {{-- Main Welcome Banner/Hero Area --}}
        <div class="card rounded-0 shadow-sm" style="border: 2px solid #3b5734; margin-bottom: 30px;">
            <div class="card-header rounded-0" style="background-color: #486b40; color: #fff; text-align: center; padding: 15px;">
                <h1 style="font-family: 'Georgia', serif; font-size: 32px; font-weight: bold; margin: 0;">
                    Welcome to the Market
                </h1>
                <p style="font-size: 14px; color: #aacc99; margin: 5px 0 0 0;">
                    Secure Exchange. Private Transactions.
                </p>
            </div>
            <div class="card-body" style="background-color: #e8e8e3; padding: 40px; text-align: center;">
                <p style="font-size: 16px; color: #333; line-height: 1.6;">
                    This is a hidden bazaar for those who value privacy above all. Transactions are encrypted, anonymous, and mediated entirely by our secure infrastructure. Whether you are browsing for unique listings or creating your own, discretion is key.
                </p>
                <p style="font-size: 14px; color: #555;">
                    <span style="font-weight: bold;">NOTICE:</span> New users are advised to read the FAQ before proceeding.
                </p>
                
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-lg rounded-0" 
                        style="background-color: #cc0000; color: white; border: 1px solid #990000; font-weight: bold; margin-right: 15px;">
                        LOG IN
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-lg rounded-0" 
                        style="background-color: #007bff; color: white; border: 1px solid #0056b3; font-weight: bold;">
                        REGISTER NEW ACCOUNT
                    </a>
                </div>
            </div>
        </div>

        {{-- Marketplace Statistics / Quick Info --}}
        <div class="row text-center">
            <div class="col-md-4">
                <div class="p-3 mb-3 rounded-0" style="border: 1px solid #ccc; background-color: #fff;">
                    <h5 style="color: #486b40; font-weight: bold;">999+</h5>
                    <p class="text-muted m-0" style="font-size: 14px;">Active Listings</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 mb-3 rounded-0" style="border: 1px solid #ccc; background-color: #fff;">
                    <h5 style="color: #486b40; font-weight: bold;">125</h5>
                    <p class="text-muted m-0" style="font-size: 14px;">Vendors Online</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 mb-3 rounded-0" style="border: 1px solid #ccc; background-color: #fff;">
                    <h5 style="color: #486b40; font-weight: bold;">฿1,234.56</h5>
                    <p class="text-muted m-0" style="font-size: 14px;">Total Volume (24h)</p>
                </div>
            </div>
        </div>
        
        {{-- Call to Action: Browse Listings --}}
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-lg btn-block rounded-0" 
                style="background-color: #486b40; color: white; border: 2px solid #3b5734; font-size: 18px; width: 100%; max-width: 600px; padding: 10px 0;">
                <i class="fas fa-search me-2"></i> Browse All Listings
            </a>
        </div>

        <div class="text-center mt-5 mb-3">
             <p style="font-size: 12px; color: #888;">
                Access is logged. Do not attempt illegal activities.
            </p>
        </div>

    </div>

</x-layouts.main>