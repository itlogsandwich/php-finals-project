<?php

namespace App\Http\Controllers;

use App\Config\Categories;
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
        $categories = config('categories');

        $counts = Product::select('category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view ('products.home', compact('products', 'listings', 'categories', 'counts'));
    }

    public function categoryIndex($category)
    {
        $products = Product::all()
            ->where('category', '=', $category);
        $listings = Listing::select('user_id');
        $categories = config('categories');

        $counts = Product::select('category')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view ('products.home', compact('products', 'listings', 'categories', 'counts'));
    }

    public function productView($product_id)
    {
        $product = Product::findOrFail($product_id);
        $listing = Listing::select('user_id')->where('product_id', '=', $product_id);

        return view ('products.view', compact('product', 'listing'));
    }

}
