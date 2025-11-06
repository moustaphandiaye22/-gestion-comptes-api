<?php



namespace App\Services;



use App\Models\Compte;
use App\Models\comptes;

class CompteService
{
   public function calculerSolde(comptes $compte): float
   {
       $depotTotal = $compte->transactions()
           ->where('type', 'depot')
           ->sum('montant');


       $retraitTotal = $compte->transactions()
           ->where('type', 'retrait')
           ->sum('montant');


       $virementTotal = $compte->transactions()
           ->where('type', 'virement')
           ->sum('montant');


       $fraisTotal = $compte->transactions()
           ->where('type', 'frais')
           ->sum('montant');


       return $compte->solde_initial + $depotTotal - $retraitTotal - $virementTotal - $fraisTotal;
   }

   public function getAllComptes($queryParams = [] )
   {
       $query = comptes::with(['transactions'])
            ->search($queryParams['search'] ?? null)
           ->sortAndOrder($queryParams['sort'] ?? null, $queryParams['order'] ?? null);

       return $query->paginate($queryParams['limit'] ?? 10, ['*'], 'page', $queryParams['page'] ?? 1);
   }



}
