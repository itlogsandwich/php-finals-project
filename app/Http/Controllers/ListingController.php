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

    public function listingUpdateForm($product_id)
    {
        $product = Product::findOrFail($product_id);

        return view('listings.update', compact('product'));
    }

    public function listingCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string|in:drugs,electronics,apparel,food,tools,miscellaneous',
            'price' => 'required|numeric|min:0',
            'image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if($request->hasFile('image_path'))
        {
            $imagePath = $request->file('image_path')->store('products', 'public');
        }


        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'price' => $validated['price'],
            'image_path' => $imagePath, // save the stored file path
        ]);

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


    public function listingUpdate(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'category' => 'required|string|in:electronics,apparel,food,medication,tools,miscellaneous',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
        ]);

        $product->update($validated);

        return redirect()->route('listing.show')->with('success message', 'Listing updated successfully');
    }
}
