<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function search(Request $request): View|RedirectResponse
    {
        $request->validate([
            'search-term' => 'required|string|max:30',
        ]);

        $searchTerm = $request->input('search-term', '');

        if (empty($searchTerm)) {
            return to_route('home');
        }

        return view('pages.home', [
            'offres' => $this->getFilteredOffres($searchTerm),
            'searchTerm' => $searchTerm,
        ]);
    }

    private function getFilteredOffres(?string $searchTerm = null)
    {
        return Offre::with('category')
//            ->validated()
            ->whereDate('date_debut', '<=', now())
            ->whereDate('date_fin', '>=', now())
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->whereAny(['title', 'type_offre'], 'LIKE', '%'.$searchTerm.'%');
            })
            ->latest('date_fin')
            ->paginate(10);
    }

    public function index(): View
    {
        return view('pages.home', [
            'offres' => $this->getFilteredOffres(),
        ]);
    }
}
