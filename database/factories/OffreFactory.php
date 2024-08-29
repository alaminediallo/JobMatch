<?php

namespace Database\Factories;

use App\Enums\TypeOffre;
use App\Models\Offre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffreFactory extends Factory
{
    protected $model = Offre::class;

    public function definition(): array
    {
        $dateDebut = $this->faker->dateTimeBetween('-3 days');
        $dateFin = $this->faker->dateTimeBetween($dateDebut, '+1 year');

        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->realTextBetween(500, 700),
            'salaire_proposer' => $this->faker->numberBetween(10, 99).'0000',
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => $dateFin->format('Y-m-d'),
            'type_offre' => $this->faker->randomElement(TypeOffre::getValues()),
            'user_id' => User::factory(),
        ];
    }
}
