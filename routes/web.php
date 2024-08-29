<?php

use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::get('/home', static function () {
//    return view('pages.home');
//})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
//    Route::resource('role', RoleController::class);
//    route::get('role/activer/{role}', [RoleController::class, 'activer'])->name('role.activer');

    Route::prefix('candidat')->group(function () {
        Route::resource('langue', LangueController::class);
        Route::resource('competence', CompetenceController::class)->except('show');
        Route::resource('experience', ExperienceController::class);
        Route::resource('formation', FormationController::class);
    });

    Route::resource('offre', OffreController::class);

    Route::resource('user', UsersController::class);
    Route::patch('/users/{user}/activate', [UsersController::class, 'activate'])->name('user.activate');
    Route::patch('/users/{user}/deactivate', [UsersController::class, 'deactivate'])->name('user.deactivate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
