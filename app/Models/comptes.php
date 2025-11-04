<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class comptes extends Model
{
    use HasFactory;
    public $incrementing = false;
   protected $keyType = 'string';
   protected $appends = ['solde'];


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
           if (empty($model->numeroCompte)) {
               // Exemple : CPT-2025-XXXXX
               $model->numeroCompte = 'CPT-' . date('Y') . '-' . strtoupper(Str::random(6));
           }
       });
   }




   public function client()
   {
       return $this->belongsTo(clients::class);
   }


   public function transactions()
   {
       return $this->hasMany(transactions::class);
   }


   public function getMetadonneesAttribute($value)
   {
       return json_decode($value, true) ?? [];
   }


   public function setMetadonneesAttribute($value)
   {
       $this->attributes['metadonnees'] = json_encode($value);
   }
   public function getSoldeAttribute() {}




   protected $fillable = [
       'client_id',
       'numero_compte',
       'titulaire',
       'type',
       'solde_initial',
       'devise',
       'date_creation',
       'statut',
       'metadonnees',
       'date_fermeture',
       'motifBlocage',
       'dateBlocage',
       'dateDeblocagePrevue',
       'motifDeblocage',
       'dateDeblocage',
   ];


   protected $casts = [
       'metadonnees' => 'array',
       'date_creation' => 'datetime',
       'solde_intitial' => 'decimal:2',
       'dateBlocage' => 'datetime',
       'dateDeblocagePrevue' => 'datetime',
       'dateDeblocage' => 'datetime',
       'date_fermeture' => 'datetime',
   ];





}
