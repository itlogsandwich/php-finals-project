<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ListingController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//TODO - Instead of redirecting to breeze default dashboard, let's redirect to our own personalized dashboard
//Profile and Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//DISPLAYS THE HOME OR MAIN MENU
Route::get('/home', [ProductController::class, 'productIndex'])->name('home');


//PRODUCT AND LISTING
Route::middleware('auth')->group(function()
{
    Route::get('/listing/create', [ListingController::class, 'listingForm'])->name('listing.form');
    Route::post('/listing/create', [ListingController::class, 'listingCreate'])->name('listing.create');

    Route::get('listing/show', [ListingController::class, 'listingShow'])->name('listing.show');
});

require __DIR__.'/auth.php';
