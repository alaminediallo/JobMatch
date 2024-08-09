<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Route::view('/', 'landing');
//Route::match(['get', 'post'], '/dashboard', function(){
//    return view('dashboard');
//});

//Route::middleware('auth')->group(function () {
//    Route::view('/pages/slick', 'pages.slick');
//    Route::view('/pages/datatables', 'pages.datatables');
//    Route::view('/pages/blank', 'pages.blank');
//});

Route::redirect('/', '/dashboard');

Route::get('/dashboard', static function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
