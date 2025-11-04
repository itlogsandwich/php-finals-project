<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Listing;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function productIndex()
    {
        $products = Product::all();

        $listings = Listing::select('user_id');
        return view ('products.home', compact('products', 'listings'));
    }

}
