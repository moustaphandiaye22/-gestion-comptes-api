<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admins extends Model
{

    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'prenom',
        'nom',
        'telephone',


    ];
    public function user()
    {
        return $this->morphOne(User::class, 'authenticatable');
    }



}
