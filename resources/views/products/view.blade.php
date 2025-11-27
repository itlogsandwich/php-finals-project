<x-layouts.main>

    <style>
        /* Base Styling */
        body { font-family: Tahoma, Arial, sans-serif; }
        a { text-decoration: none; color: #486b40; }
        a:hover { text-decoration: underline; }

        /* Main container box for the product details */
        .sr-detail-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 0;
            padding: 20px;
            display: flex;
        }

        /* Left Column: Image */
        .sr-image-panel {
            flex-basis: 40%;
            max-width: 40%;
            padding-right: 20px;
        }
        .sr-product-image {
            width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 0;
            background-color: #fcfcfc;
        }

        /* Right Column: Info & Actions */
        .sr-info-panel {
            flex-basis: 60%;
            max-width: 60%;
            padding-left: 20px;
            border-left: 1px solid #eee;
            text-align: left;
        }

        /* Typography */
        .sr-title {
            color: #333;
            font-family: Georgia, serif;
            font-size: 24px;
            border-bottom: 2px solid #486b40;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .sr-seller-link {
            color: #486b40;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
        }
        .sr-description {
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #555;
        }
        .sr-price {
            font-size: 28px;
            font-weight: bold;
            color: #e67e22; /* Gold/Orange BTC color */
            margin-bottom: 20px;
            display: block;
        }

        /* Buttons (Shared Style) */
        .sr-btn-primary {
            background-color: #486b40; /* Forest Green */
            color: white;
            padding: 8px 15px;
            font-size: 15px;
            border: 1px solid #3b5734;
            border-radius: 0;
            width: 100%;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .sr-btn-secondary {
            background-color: #f9f9f9;
            color: #333;
            padding: 8px 15px;
            font-size: 15px;
            border: 1px solid #999;
            border-radius: 0;
            width: 100%;
            font-weight: bold;
        }
        .sr-btn-danger {
            background-color: #C9302C;
            color: white;
            padding: 8px 15px;
            font-size: 15px;
            border: 1px solid #999;
            border-radius: 0;
            width: 100%;
            font-weight: bold;
        }

        /* Similar Items Footer */
        .sr-footer-header {
            background-color: #f7f7f7;
            border: 1px solid #ddd;
            border-bottom: none;
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            margin-top: 30px;
            border-radius: 0;
        }
        .sr-similar-item {
            border: 1px solid #ddd;
            background-color: #fff;
            margin: 5px;
            padding: 5px;
            max-width: 180px;
        }
        .sr-similar-item img {
            width: 100%;
            height: auto;
            border-radius: 0;
        }
    </style>
    <div style="max-width: 1000px; margin: 20px auto;">

        <div class="sr-detail-box">

            <div class="sr-image-panel">
                <img src="{{ asset('storage/' . $product->image_path) }}" class="sr-product-image" alt="product image">

                <div style="text-align: center; margin-top: 10px; font-size: 12px; color: #777;">
                    Category: {{ ucfirst($product->category) }}
                </div>
            </div>

            <div class="sr-info-panel">

                <h1 class="sr-title">{{ $product->name }}</h1>

                <a href="#" class="sr-seller-link">Vendor: {{ $user->name }}</a>

                <span class="sr-price">฿{{ number_format($product->price, 6) }}</span>

                <p class="sr-description">
                    **Description:** <br>
                    {{ $product->description }}
                </p>

                @if(Auth::id() !== $user->id)
                <div style="margin-top: 20px;">
                    <form method="POST" action="{{ route('conversation.start', ['receiver_id' => $user->id]) }}">
                        @csrf  
                        <button class="sr-btn-primary" type="submit">Contact Seller / Make Offer</button>
                    </form>

                    <form method="POST" action="{{ route('favorite.add', ['listing_id' => $listing->id]) }}">
                        @csrf
                        <button class="sr-btn-secondary" type="submit">Add to Favorites</button>
                    </form>
                </div>
                @else
                <div style="margin-top: 20px;">
                    <form method="GET" action="{{ route('listing.update.form', ['product_id' => $listing->product_id]) }}">
                        @csrf  
                        <button class="sr-btn-primary" type="submit">Edit Listing</button>
                    </form>

                    <form method="POST" action="{{ route('listing.remove', ['product_id' => $listing->product_id]) }}" onsubmit="return confirm('Are you sure you want to remove this listing?')" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="sr-btn-danger" type="submit">Remove Listing</button>
                    </form>
                </div>
                @endif

            </div>
        </div>

        <footer>
            <div class="sr-footer-header">
                Similar Items You Might Like
            </div>

            <div class="d-flex flex-row justify-content-between" style="padding: 10px; border: 1px solid #ddd; border-top: none;">
                @for ($i = 1; $i <=5; $i++)
                <div class="sr-similar-item">
                    <img src="{{ asset('storage/' . $product->image_path)}}" alt="similar product image">
                    <div style="font-size: 12px; margin-top: 5px; text-align: center;">
                        <a href="#">Item Name {{$i}}</a>
                        <span style="display: block; font-weight: bold; color: #e67e22;">฿4.{{$i}}0</span>
                    </div>
                </div>
                @endfor
            </div>

        </footer>
    </div>
</x-layouts.main>
