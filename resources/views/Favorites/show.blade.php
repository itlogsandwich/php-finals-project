<x-layouts.main>
    
    <style>
        /* Base styling for typography and links */
        body { font-family: Tahoma, Arial, sans-serif; }
        a { text-decoration: none; color: #486b40; } 
        a:hover { text-decoration: underline; }

        /* Container for each favorite item */
        .sr-favorite-item {
            background-color: #fff;
            border: 1px solid #c0c0c0; /* Simple gray border */
            border-radius: 0;
            margin-bottom: 15px;
            display: flex; /* Use flex for the main row layout */
        }

        /* Left Section: Image */
        .sr-image-section {
            flex-basis: 150px; /* Fixed width for image column */
            max-width: 150px;
            padding: 5px;
            border-right: 1px solid #eee;
        }
        .sr-favorite-image {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 0;
        }

        /* Middle Section: Details */
        .sr-details-section {
            flex-grow: 1;
            padding: 10px 15px;
        }
        .sr-item-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .sr-item-price {
            font-size: 18px;
            font-weight: bold;
            color: #e67e22; /* Gold/Orange BTC color */
            margin-top: 5px;
        }
        .sr-item-text {
            font-size: 13px;
            color: #555;
            margin-bottom: 2px;
        }

        /* Right Section: Actions */
        .sr-action-section {
            width: 150px; /* Fixed width for action column */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
            border-left: 1px solid #eee;
        }

        /* Action Buttons */
        .sr-btn-remove {
            background-color: #993333; /* Darker red for utilitarian remove button */
            color: white;
            padding: 6px 15px;
            font-size: 13px;
            border: 1px solid #772222;
            border-radius: 0;
            width: 100%;
            margin-top: 5px;
            font-weight: bold;
            text-align: center;
        }
        .sr-btn-view {
            background-color: #f9f9f9;
            color: #333;
            padding: 6px 15px;
            font-size: 13px;
            border: 1px solid #999;
            border-radius: 0;
            width: 100%;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: center;
        }
    </style>
    <div class="container" style="max-width: 900px; margin-top: 20px;">

        <h1> Favorites </h1>

        @if (session()->has('success'))
            <x-forms.alert type='success' :message="session('success')" />
        @endif

        @if (session()->has('error'))
            <x-forms.alert type='danger' :message="session('error')" />
        @endif
        
        <div style="margin-top: 15px;">
            @foreach ($favorites as $favorite)
            <div class="sr-favorite-item">
                
                <div class="sr-image-section">
                    <a href="{{ route('productView', ['product_id' => $favorite->listing->product->id]) }}">
                        <img src="{{ asset('storage/' . $favorite->listing->product->image_path) }}" class="sr-favorite-image" alt="product image">
                    </a>
                </div>
                
                <div class="sr-details-section">
                    <a href="{{ route('productView', ['product_id' => $favorite->listing->product->id]) }}" class="sr-item-title"> 
                        {{ $favorite->listing->product->name }} 
                    </a>
                    
                    <p class="sr-item-text">
                        {{ Str::limit($favorite->listing->product->description, 100) }} 
                    </p>
                    
                    <p class="sr-item-text"> 
                        **Category:** {{ ucfirst($favorite->listing->product->category) }} 
                    </p>
                    
                    <p class="sr-item-price"> 
                        ฿{{ number_format($favorite->listing->product->price, 6) }} 
                    </p>
                </div>
                
                <div class="sr-action-section">
                    <a href="{{ route('productView', ['product_id' => $favorite->listing->product->id]) }}" class="sr-btn-view">
                        View Listing
                     </a>

                    <form method="post" action="{{ route('favorite.remove', ['favorite_id' => $favorite->id]) }}" onsubmit="return confirm('Are you sure you want to remove this from your favorites?')" style="width: 100%;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="sr-btn-remove"> Remove </button>
                    </form>
                </div>
                
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.main>

<!-- i think its fixed, check lang, all i did was ui and a lil mwamwachupchip -->