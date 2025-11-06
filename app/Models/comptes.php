<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Scopes\ActiveScope;

class comptes extends Model
{
    use HasFactory;
    public $incrementing = false;
   protected $keyType = 'string';
   protected $appends = ['solde'];

    protected static function newFactory()
    {
        return \Database\Factories\ComptesFactory::new();
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
           if (empty($model->numero_compte)) {
               // Exemple : CPT-2025-XXXXX
               $model->numero_compte = 'CPT-' . date('Y') . '-' . strtoupper(Str::random(6));
           }
       });
       static::addGlobalScope(new ActiveScope());
   }

     public function scopeFilterByType($query, $type)
   {
       if (!empty($type)) {
           $query->where('type', $type);
       }
       return $query;
   }
   
   public function scopeSearch($query, $search)
   {
       if ($search) {
           return $query->where('titulaire', 'LIKE', '%' . $search . '%')
               ->orWhere('numero_compte', 'LIKE', '%' . $search . '%');
       }
       return $query;
   }

   public function scopeSortAndOrder($query, $sort, $order)      
    {
        $sort = $sort ?: 'created_at';
       $order = in_array(strtolower($order), ['asc', 'desc']) ? $order : 'desc';
       return $query->orderBy($sort, $order); 
    }

       public function scopePaginatePageAndLimit($query, $page, $limit)
   {
       $page = max(1, (int)$page);
       $limit = min($limit ?: 10, 100);
       $offset = ($page - 1) * $limit;
       return $query->skip($offset)->take($limit);
   }




   public function client()
   {
       return $this->belongsTo(clients::class);
   }


   public function transactions()
   {
       return $this->hasMany(transactions::class, 'compte_id');
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
