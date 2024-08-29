<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\View\View;

class HomeController extends Controller
{
    // TODO: Faire valider l'offre par l'admin avant de les afficher
    public function index(): View
    {
        $offres = Offre::with('category')
            ->where('date_fin', '>=', now())
            ->latest('date_fin')
            ->paginate(10);


        return view('pages.home', [
            'offres' => $offres,
        ]);
    }
}
