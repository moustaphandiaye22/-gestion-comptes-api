<?php

namespace Database\Seeders;



use App\Models\Admin;
use App\Models\admins;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class AdminsSeeder extends Seeder
{
   /**
    * Run the database seeds.
    */
   public function run(): void
   {
      
       admins::factory()->count(5)->create()->each(function ($admin) {
           // Creer un utilisateur associe pour chaque admin
           $user = \App\Models\User::factory()->create([
               'authenticatable_type' => admins::class,
               'authenticatable_id' => $admin->id,
               'is_active' => true,
           ]);
       });


   }
}

