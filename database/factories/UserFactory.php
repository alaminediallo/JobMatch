<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nom = ['Ndiaye', 'Diop', 'Bah', 'Diallo', 'Faye', 'Sow', 'Sy', 'Sarr', 'Kane',
            'Thiam', 'Fall', 'Dieng', 'Camara'];

        $prenom = ['Mamadou', 'Fatou', 'Abdoulaye', 'Adama', 'Amadou', 'Mariama', 'Ousmane',
            'Ibrahima', 'Astou', 'Aliou', 'Zeynabou', 'Cheikh', 'Moussa', 'Lamine', 'Souleymane', 'Bintou'];

        $safeEmail = fake()->unique()->safeEmail();

        return [
            'name' => fake()->randomElement($nom),
            'prenom' => fake()->randomElement($prenom),
            'email' => $safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make($safeEmail),
            'type_user' => 'Candidat',
            'adresse' => fake()->address(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function entreprise(): static
    {
        return $this->state(fn (array $attributes) => [
            'type_user' => 'Entreprise',
            'nom_entreprise' => fake()->company(),
            'description_entreprise' => fake()->realTextBetween(200, 300),
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'type_user' => 'Administrateur',
        ]);
    }
}
