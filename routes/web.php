<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TransactionController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //USER WALLET
    Route::post('/profile', [ProfileController::class, 'cashIn'])->name('profile.wallet');
});


//DISPLAYS THE HOME OR MAIN MENU
Route::get('/', [ProductController::class, 'productIndex'])->name('home');
Route::get('/home/{category}', [ProductController::class, 'categoryIndex'])->name('viewCategory');

Route::get('/home/view/{product_id}', [ProductController::class, 'productView'])->name('productView')->middleware('auth');

//PRODUCT AND LISTING
Route::middleware('auth')->group(function()
{
    Route::get('/listing/create', [ListingController::class, 'listingForm'])->name('listing.form');
    Route::post('/listing/create', [ListingController::class, 'listingCreate'])->name('listing.create');

    Route::get('/listing/show', [ListingController::class, 'listingShow'])->name('listing.show');
    Route::delete('/listing/show/{product_id}',[ListingController::class, 'listingRemove'])->name('listing.remove');

    Route::get('/listing/update/{product_id}',[ListingController::class, 'listingUpdateForm'])->name('listing.update.form');
    Route::post('/listing/update/{product_id}', [ListingController::class, 'listingUpdate'])->name('listing.update');

    Route::get('/favorite', [FavoriteController::class, 'favoriteShow'])->name('favorite.show');
    Route::post('/favorite/{listing_id}', [FavoriteController::class, 'favoriteAdd'])->name('favorite.add');
    Route::delete('/favorite/{favorite_id}', [FavoriteController::class, 'favoriteRemove'])->name('favorite.remove');

    Route::get('/faq', [ProfileController::class, 'faqShow'])->name('faq.show');
});

Route::middleware('auth')->group(function()
{
    Route::get('/transaction/history', [TransactionController::class, 'transactionShow'])->name('transaction.show'); 
    Route::post('/transaction/history/{listing_id}/{buyer_id}/{seller_id}', [TransactionController::class, 'transactionPurchase'])->name('transaction.purchase'); 
});
//MESSAGE AND CONVERSATION
Route::middleware('auth')->group(function()
{
    Route::get('/conversation', [ConversationController::class, 'conversationShow'])->name('conversation.show');
    Route::post('/conversation/start/{receiver_id}', [ConversationController::class, 'conversationStart'])->name('conversation.start');
    Route::get('/message/{conversation_id}', [MessageController::class, 'messageShow'])->name('message.show');
    Route::post('message/{conversation_id}', [MessageController::class, 'messageSend'])->name('message.send');
});

//ADMIN
Route::middleware('auth')->group(function()
{
    Route::get('/index/users', [ProfileController::class, 'index'])->name('admin.index');
    Route::delete('/index/users/{user_id}', [ProfileController::class, 'userRemove'])->name('admin.remove');
});

require __DIR__.'/auth.php';
