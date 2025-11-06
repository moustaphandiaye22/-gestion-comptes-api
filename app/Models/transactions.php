<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class transactions extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Database\Factories\TransactionsFactory::new();
    }

    protected static function boot()
   {
       parent::boot();


       // Generate UUID for primary key
       static::creating(function ($model) {
           if (empty($model->id)) {
               $model->id = (string) Str::uuid();
           }
       });


       static::creating(function ($model) {
           if (empty($model->reference)) {
               // Exemple : TXN-2025-XXXXX
               $model->reference = 'TXN-' . date('Y') . '-' . strtoupper(Str::random(6));
           }
       });
   }


   public function compte()
   {
       return $this->belongsTo(comptes::class);
   }


   protected $fillable = [
       'compte_id',
       'type',
       'montant',
       'description',
       'date_transaction'
   ];
  

}
