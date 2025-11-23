<x-layouts.main>

<style>
/* Replicating the classic Silk Road UI look for tables/boxes */

/* The main white box for each listing */
.sr-listing-box {
    background-color: #fff;
    border: 1px solid #c0c0c0; /* Thin, simple grey border */
    margin-top: 15px;
    margin-bottom: 15px;
    border-radius: 0; /* Square corners */
    width: 100%; /* Make it full width of the container */
}

/* Inner padding and row style */
.sr-listing-body {
    display: flex; /* Using flex for a reliable layout */
    align-items: stretch;
    padding: 0;
}

/* Listing details and text */
.sr-info-panel {
    padding: 15px;
    font-size: 13px;
    border-right: 1px solid #f0f0f0;
}

/* Image styling */
.sr-img-container {
    border-right: 1px solid #e0e0e0;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f7f7f7;
}
.sr-img-container img {
    max-width: 100%;
    height: auto;
    display: block;
    border-radius: 0;
    border: 1px solid #ccc;
}

/* Title styling */
.sr-title {
    font-family: &#39;Georgia&#39;, serif;
    font-size: 16px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

/* Price styling */
.sr-price {
    font-size: 14px;
    font-weight: bold;
    color: #d89b0d; /* Gold/Bitcoin color */
    margin-top: 5px;
}

/* Status/Action Panel styling */
.sr-action-panel {
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start; /* Align to top */
    align-items: center;
    background-color: #fcfcfc;
    border-left: 1px solid #f0f0f0;
}

/* Custom button styling (Gray for Edit, Red for Remove) */
.sr-btn-edit {
    background: linear-gradient(to bottom, #f9f9f9, #e9e9e9);
    border: 1px solid #999;
    color: #333;
    padding: 3px 10px;
    font-size: 12px;
    font-weight: bold;
    text-decoration: none;
    display: inline-block;
    border-radius: 2px;
}
.sr-btn-remove {
    background-color: #c9302c; /* Muted Red */
    border: 1px solid #ac2925;
    color: white;
    padding: 3px 10px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 2px;
}

/* Custom button styling (Green for New Listing) - Added back for the new button */
.sr-btn-create {
    background-color: #486b40; /* Dark Green */
    border: 1px solid #3b5734;
    color: white;
    padding: 5px 12px;
    font-size: 14px;
    font-weight: bold;
    border-radius: 2px;
    text-decoration: none;
    transition: background-color 0.1s;
}
.sr-btn-create:hover {
    background-color: #3b5734;
    color: white;
}

/* Alert styling (Guessing your component structure) */
.alert-success {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
    padding: 8px 15px;
    border-radius: 0;
    border-width: 1px;
}
.alert-danger {
    background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
    padding: 8px 15px;
    border-radius: 0;
    border-width: 1px;
}


</style>

<div class="container mt-4" style="max-width: 900px;">

{{-- HEADER WITH CREATE BUTTON (UPDATED) --}}
<div class="d-flex justify-content-between align-items-center" style="margin-bottom: 15px;">
    {{-- Title Block --}}
    <div style="background-color:#486b40; color:white; padding: 8px 15px; font-weight: bold; border: 1px solid #3b5734; border-radius: 0;">
        Your Active Listings
    </div>
    {{-- NEW CREATE LISTING BUTTON --}}
    <a href="{{ route('listing.form') }}" class="sr-btn-create">
        + Create New Listing
    </a>
</div>

@if (session()->has('success'))
    <div class="alert-success mb-3">
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div class="alert-danger mb-3">
        {{ session('error') }}
    </div>
@endif

<div class="d-flex flex-column">
    @foreach ($listings as $listing)
    <div class="sr-listing-box">
        <div class="row g-0 sr-listing-body">
            
            <div class="col-md-3 sr-img-container">
                <img src="{{ asset('storage/' . $listing->product->image_path) }}" 
                     alt="product image" 
                     style="max-height: 150px;"
                     onerror="this.onerror=null;this.src='https://placehold.co/200x150/f7f7f7/888888?text=NO+IMAGE';">
            </div>
            
            <div class="col-md-6 sr-info-panel">
                <h3 class="sr-title">{{ $listing->product->name }}</h3>
                <p style="margin-bottom: 5px;">{{ Str::limit($listing->product->description, 100) }}</p>
                
                <p style="margin-bottom: 5px;">**Category:** {{ ucfirst($listing->product->category) }}</p>
                
                <p class="sr-price">Price: ₿{{ number_format($listing->product->price, 6) }}</p>
            </div>
            
            <div class="col-md-3 sr-action-panel">
                {{-- ROUTE PARAMETER: Using product_id as defined in your latest web.php --}}
                <a href="{{ route('listing.update.form', ['product_id' => $listing->product_id]) }}" class="sr-btn-edit"> Edit Listing </a>

                {{-- ROUTE PARAMETER: Using product_id as defined in your latest web.php --}}
                <form method="post" action="{{ route('listing.remove', ['product_id' => $listing->product_id]) }}" onsubmit="return confirm('Are you sure you want to remove this listing?')" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="sr-btn-remove"> Remove </button>
                </form>
                
                <div style="margin-top: 15px; font-size: 11px; color: #888;">
                    Views: 45 | Status: Active
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


</div>

</x-layouts.main>