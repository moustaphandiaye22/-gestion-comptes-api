<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\clients>
 */
class ClientsFactory extends Factory
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
           'nom' => fake()->lastName(),
           'prenom' => fake()->firstName(),
           'datenaissance' => fake()->date(),
           'adresse' => fake()->address(),
           'telephone' => '+221' . fake()->numerify('77#######'),
           'cni' => fake()->unique()->numerify('1############'),
       ];
   }

}
