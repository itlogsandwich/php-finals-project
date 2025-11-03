<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use Illuminate\Http\Request;
class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function listingForm()
    {
        return view('listings.create');
    }

    public function listingShow()
    {
        $listings = Listing::with(['user', 'product'])->get();

        return view('listings.show', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function listingCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string|in:electronics,apparel,food,medication,tools,miscellaneous',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
        ]);

        $product = Product::create($validated);

        Listing::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return redirect()->route('listing.show')->with('success', 'Listing added successfully!');
    }

    public function listingRemove($product_id)
    {
        $product = Product::findOrFail($product_id);

        $product->delete();

        return redirect()->route('listing.show')->with('success message', 'Listing rmemoved successfully');
    }
}
