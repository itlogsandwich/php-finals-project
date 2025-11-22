<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Listing;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{ 
    public function favoriteShow()
    {
        $favorites = Favorite::with('listing')
            ->where('user_id', auth()->id())
            ->get();

        return view('favorites.show', compact('favorites'));
    }

    public function favoriteAdd($listing_id)
    {
        $listing = Listing::findOrFail($listing_id);

        $favorite = Favorite::create([
            'user_id' => auth()->id(),
            'listing_id' => $listing->id
        ]);

        return redirect()->route('favorite.show', $favorite->id);
    }

    public function favoriteRemove($favorite_id)
    {
        $favorite = Favorite::findOrFail($favorite_id);

        $favorite->delete();

        return redirect()->route('favorite.show')->with('success message', 'Unfavorited!');
    }

}
