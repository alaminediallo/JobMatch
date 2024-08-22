<?php

namespace Database\Seeders;

use App\Models\TypeEntreprise;
use Illuminate\Database\Seeder;

class TypeEntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        // Définir manuellement les types d'entreprises spécifiques
        $types = collect([
            'Banques et Institutions Financières',
            'Compagnies d\'Assurances',
            'Télécommunications',
            'Startups Technologiques',
            'Cabinets de Conseil',
            'Entreprises de BTP (Bâtiment et Travaux Publics)',
            'Administrations Publiques',
            'Entreprises Publiques',
            'Éducation et Recherche',
            'Organisations Non-Gouvernementales',
            'Agences des Nations Unies',
            'Associations Locales',
            'Coopératives Agricoles',
            'Entreprises de Transformation',
            'Import/Export Agricole',
            'Groupes de Distribution',
            'E-commerce',
            'Commerces de Détail',
            'Chaînes Hôtelières',
            'Agences de Voyage',
            'Secteur du Tourisme',
            'Recrutement et RH',
            'Formation Professionnelle',
            'Services de Nettoyage et de Sécurité',
            'Production Audiovisuelle',
            'Média et Communication',
            'Mode et Design',
        ]);

        $types->each(fn($type) => TypeEntreprise::firstOrCreate(['name' => $type]));
    }
}
