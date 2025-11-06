<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transactions>
 */
class TransactionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  public function definition(): array
   {
       return [
           'reference' => 'TXN-' . date('Y') . '-' . strtoupper(fake()->bothify('??????')),
           'statut' => fake()->randomElement(['en_attente', 'validee', 'annulee']),
           'type' => fake()->randomElement(['depot', 'retrait', 'virement', 'frais']),
           'montant' => fake()->randomFloat(2, 1000, 10000),
           'description' => fake()->sentence(),
           'date_transaction' => now(),
       ];
   }

}
