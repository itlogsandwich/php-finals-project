<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CannabisController;
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

Route::get('/', [CannabisController::class, 'home'])->name('cannabis.home');
//Products
Route::middleware('auth')->group(function()
{

});

require __DIR__.'/auth.php';
