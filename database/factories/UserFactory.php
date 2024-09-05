<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Offre;
use App\Models\Role;
use App\Models\TypeEntreprise;
use App\Models\User;
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
        $noms = collect([
            'Ndiaye', 'Diop', 'Bah', 'Diallo', 'Faye', 'Sow', 'Sy', 'Sarr', 'Kane',
            'Thiam', 'Fall', 'Dieng', 'Camara',
        ]);

        $prenoms = collect([
            'Mamadou', 'Fatou', 'Abdoulaye', 'Adama', 'Amadou', 'Mariama', 'Ousmane',
            'Ibrahima', 'Astou', 'Aliou', 'Zeynabou', 'Cheikh', 'Moussa', 'Lamine', 'Souleymane', 'Bintou',
        ]);

        $safeEmail = fake()->unique()->safeEmail();

        return [
            'name' => $noms->random(),
            'prenom' => $prenoms->random(),
            'email' => $safeEmail,
            'password' => Hash::make($safeEmail),
            'tel' => fake()->phoneNumber(),
            'role_id' => Role::factory(),
            'adresse' => fake()->address(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $recruteurRoleId = Role::where('name', 'Recruteur')->value('id');

            if ($user->role_id === $recruteurRoleId) {
                $randomTypeEntrepriseId = TypeEntreprise::inRandomOrder()->value('id');

                $user->update([
                    'nom_entreprise' => fake()->company(),
                    'description_entreprise' => fake()->realTextBetween(200, 300),
                    'type_entreprise_id' => $randomTypeEntrepriseId,
                ]);

                Offre::factory(random_int(1, 2))->create([
                    'user_id' => $user->id,
                    'category_id' => Category::inRandomOrder()->value('id'),
                ]);
                Offre::factory(random_int(2, 3))->create([
                    'user_id' => $user->id,
                    'category_id' => Category::inRandomOrder()->value('id'),
                ]);
            }
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
