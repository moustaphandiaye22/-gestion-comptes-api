<?php

namespace Database\Seeders;


use App\Models\Client;
use App\Models\clients;
use App\Models\Compte;
use App\Models\comptes;
use App\Models\Transaction;
use App\Models\transactions;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ClientSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
       clients::factory()->count(10)->create()->each(function ($client) {
           // Creer un utilisateur associe pour chaque client
           $user = User::factory()->create([
               'authenticatable_type' => clients::class,
               'authenticatable_id' => $client->id,
               'is_active' => true,
           ]);


           // Creer 1 à 3 comptes pour chaque client avec le bon
           comptes::factory()->count(rand(1, 3))->create([
               'client_id' => $client->id,
               'titulaire' => $client->nom . ' ' . $client->prenom,
           ])->each(function ($compte) {
               // Optionnel: Creer des transactions pour chaque compte
               transactions::factory()->count(rand(1, 5))->create([
                   'compte_id' => $compte->id,
               ]);
           });


       });
   }
}

