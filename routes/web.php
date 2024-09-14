<?php

use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'home');
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('search', [HomeController::class, 'search'])->name('home.search');

Route::get('mailable', function () {
    $candidature = App\Models\Candidature::find(1);

    return new App\Mail\CandidatureSubmittedMail($candidature, App\Models\Offre::find($candidature->offre_id));
});

Route::middleware('auth')->group(function () {
    Route::prefix('candidat')
        ->middleware('can:view-candidat-settings')
        ->group(function () {
            Route::resource('langue', LangueController::class);
            Route::resource('competence', CompetenceController::class)->except('show');
            Route::resource('experience', ExperienceController::class);
            Route::resource('formation', FormationController::class);
        });

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('offre', OffreController::class)->except('show');

    Route::patch('offres/{offre}/validate', [OffreController::class, 'validateOffre'])
        ->name('offre.validate');

    Route::patch('offres/{offre}/rejeter', [OffreController::class, 'rejeterOffre'])
        ->name('offre.rejeter');

    Route::middleware('verified')->group(function () {
        Route::get('offre/{offre}/postuler', [CandidatureController::class, 'create'])->name('candidature.create');
        Route::post('offre/{offre}/postuler', [CandidatureController::class, 'store'])->name('candidature.store');
    });

    Route::get('offre/{offre}/candidatures', [CandidatureController::class, 'index'])
        ->name('offre.candidature.index');

    Route::get('candidatures', [CandidatureController::class, 'index'])
        ->name('candidature.index')
        ->can('viewAllCandidatures', App\Models\Candidature::class);

    Route::get('offre/{offre}/candidature/{candidature}',
        [CandidatureController::class, 'show'])->name('candidature.show');

    Route::patch('candidature/{candidature}/accepter',
        [CandidatureController::class, 'accepter'])->name('candidature.accepter');

    Route::patch('candidature/{candidature}/rejeter',
        [CandidatureController::class, 'rejeter'])->name('candidature.rejeter');

    Route::resource('user', UserController::class)->except('destroy');
    Route::patch('users/{user}/activate', [UserController::class, 'activate'])->name('user.activate');
    Route::patch('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('offre/{offre}', [OffreController::class, 'show'])->name('offre.show');

require __DIR__.'/auth.php';
