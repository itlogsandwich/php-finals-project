<x-layouts.main>
    
    <style>
        /* Base Styling - Retains Theme Colors */
        body { font-family: Tahoma, Arial, sans-serif; } /* Slightly cleaner font choice */
        a { text-decoration: none; color: #486b40; } /* SR Green links */
        a:hover { text-decoration: underline; }
        
        /* --- CLEANED SIDEBAR STYLES --- */
        .sr-clean-sidebar {
            width: 240px; 
            margin-right: 30px; 
            border: 1px solid #ddd;
            background-color: #fff;
            height: fit-content;
        }
        .sr-clean-header {
            background-color: #486b40; /* SR Green */
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 15px;
            border-bottom: 2px solid #3b5734;
        }
        .sr-clean-cat-item {
            padding: 8px 15px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
            display: flex;
            justify-content: space-between;
        }
        .sr-clean-cat-item:last-child {
             border-bottom: none;
        }
        .sr-clean-cat-item:hover {
            background-color: #f7f7f7;
        }
        .sr-clean-count {
            color: #777;
            font-size: 12px;
            font-weight: bold;
        }

        /* --- CLEAN PRODUCT GRID STYLES --- */
        .sr-product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 0; /* Square look retained */
            padding: 0;
            margin-bottom: 20px;
            box-shadow: none;
            height: 100%;
            overflow: hidden;
        }
        .sr-product-card:hover {
             border-color: #486b40;
             box-shadow: 0 0 5px rgba(72, 107, 64, 0.2); 
        }

        .sr-card-img {
            max-height: 180px;
            object-fit: contain; 
            width: 100%;
            border-bottom: 1px solid #eee;
            background-color: #fcfcfc;
        }
        .sr-card-body {
            padding: 10px;
            text-align: left;
        }
        .sr-card-title {
            font-weight: bold;
            font-size: 16px;
            color: #333;
            display: block;
            height: 38px;
            overflow: hidden;
        }
        .sr-card-price {
            font-size: 17px;
            font-weight: bold;
            color: #e67e22; /* Gold/Orange BTC color */
            margin-top: 5px;
        }
        .sr-buy-btn {
            background-color: #486b40;
            color: white;
            padding: 5px 12px;
            font-size: 13px;
            border: 1px solid #3b5734;
            border-radius: 0;
            display: block;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
        }
        .sr-buy-btn:hover {
            background-color: #5a8251;
        }
    </style>
    <div class="d-flex" style="padding-top: 20px; max-width: 1200px; margin: 0 auto;">

        <div class="sr-clean-sidebar">
            <div class="sr-clean-header">
                Shop by Category
            </div>
            
            <div>
                @foreach ($categories as $category)
                <div class="sr-clean-cat-item">
                    <a href="{{ route('viewCategory', ['category' => $category]) }}" style="font-weight: bold;">
                        {{ ucfirst($category) }}
                    </a>
                    <span class="sr-clean-count">({{ $counts[$category] ?? 0 }})</span>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex-grow-1">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
                    
                    <div class="sr-product-card">
                        
                        <a href="{{ route('productView', ['product_id' => $product->id]) }}">
                             <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="sr-card-img">
                        </a>
                        
                        <div class="sr-card-body">
                            <a href="{{ route('productView', ['product_id' => $product->id]) }}" class="sr-card-title"> 
                                {{ $product->name }} 
                            </a>
                            
                            <div class="sr-card-price">
                                ฿{{ number_format($product->price, 6) }} 
                            </div>
                            
                            <a href="{{ route('productView', ['product_id' => $product->id]) }}" class="sr-buy-btn">
                                View Listing
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layouts.main>