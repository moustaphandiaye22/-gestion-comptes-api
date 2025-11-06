<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function newFactory()
    {
        return \Database\Factories\ClientsFactory::new();
    }


    protected $fillable = [
        'prenom',
        'nom',
        'telephone',
        'cni',
        'adresse',
        'datenaissance',
        ''
    ];
    public function user()
    {
        return $this->morphOne(User::class, 'authenticatable');
    }
    public function comptes()
    {
        return $this->hasMany(comptes::class, 'client_id');
    }
    
    
}
