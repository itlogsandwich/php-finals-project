<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{

    public function transactionShow()
    {
        $transactions = Transaction::with(['buyer', 'seller'])
            ->where(function($query)
            {
                $query->where('buyer_id', auth()->id())
                    ->orWhere('seller_id', auth()->id());
            })
            ->get();

        return view('transactions.history', compact('transactions'));
    }

    public function transactionPurchase($listing_id, $buyer_id, $seller_id)
    {


        $listing = Listing::with('product')->findOrFail($listing_id);
        $product = $listing->product_id;

        $buyer = User::with('wallet')->findOrFail($buyer_id);
        $seller = User::with('wallet')->findOrFail($seller_id);

        if(! Gate::allows('purchase', $product))
            return back()->with('errorMessage', 'Insufficient balance!');

        $buyerWallet = $buyer->wallet;
        $sellerWallet = $seller->wallet;


        if ($buyer->id === $seller->id)
            return back()->with('errorMessage', 'You cannot purchase your own product!');

        DB::transaction(function() use ($buyerWallet, $sellerWallet, $product, $listing, $buyer, $seller)
        {
            $buyerWallet->decrement('balance', $product->price);

            $sellerWallet->increment('balance', $product->price);

            $transaction = Transaction::create([
                'product_id' => $product->id,
                'buyer_id' => $buyer_id,
                'seller_id' => $seller_id,
                'amount' => $product-price,
            ]);


            $listing->delete();
        });

        return redirect()->route('transaction.show', compact('transaction'));
    }
}
