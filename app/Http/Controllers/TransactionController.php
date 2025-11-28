<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function transactionShow()
    {
        $transactions = Transaction::all();
        return view('transactions.history', compact('transactions'));
    }
    public function transactionPurchase($listing_id, $buyer_id, $seller_id)
    {
        $listing = Listing::findOrFail($listing_id);
        $product = Product::findOrFail($listing->product_id);

        echo($product->id);
        $transaction = Transaction::create([
            'product_id' => $product->id,
            'buyer_id' => $buyer_id,
            'seller_id' => $seller_id,
        ]);

        $listing->delete();

        return redirect()->route('transaction.show', compact('transaction'));
    }
}
