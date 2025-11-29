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

        $buyer = User::findOrFail($buyer_id);
        $seller = User::findOrFail($seller_id);

        $listing = Listing::findOrFail($listing_id);
        $product = Product::findOrFail($listing->product_id);
       
        if(! Gate::allows('purchase', $product))
            return back()->with('errorMessage', 'Insufficient balance!');

        $deduction =  [
            'wallet' => $buyer->wallet - $product->price,
        ];

        $profit = [
            'wallet' => $seller->wallet + $product->price,
        ];

        $buyer->update($deduction);
        $seller->update($profit);

        $transaction = Transaction::create([
            'product_id' => $product->id,
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id,
        ]);

        $listing->delete();

        return redirect()->route('transaction.show', compact('transaction'));
    }
}
