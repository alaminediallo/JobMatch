<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');
Route::view('/home', 'pages.home')->name('home');

//Route::get('/home', static function () {
//    return view('pages.home');
//})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('role', RoleController::class);
    route::get('role/activer/{role}', [RoleController::class, 'activer'])->name('role.activer');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
