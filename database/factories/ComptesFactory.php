<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comptes>
 */
class ComptesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     public function definition(): array
   {
       return [
           'id' => \Illuminate\Support\Str::uuid()->toString(),
           'numero_compte' => 'CPT-' . date('Y') . '-' . strtoupper(fake()->bothify('?????')),
           'titulaire' => fake()->name(),
           'type_compte' => fake()->randomElement(['epargne', 'cheque']),
           'solde_initial' => fake()->randomFloat(2, 10000, 100000),
           'devise' => 'FCFA',
           'statut' => 'actif',
           'date_creation' => now(),
           'metadonnees' => ['derniere_modification' => now(), 'version' => 1],
       ];
   }
}
