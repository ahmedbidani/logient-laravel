<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShortLinkController;
use Illuminate\Support\Facades\Route;
use App\Models\ShortLink;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $links = ShortLink::latest()->get();
    return view('welcome', compact('links'));
});
Route::middleware('auth')->group(function () {
 
    Route::resource('links', ShortLinkController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
