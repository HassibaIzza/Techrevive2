<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typepanne extends Model
{
    use HasFactory;

    // Définir les attributs fillable
    public $timestamps = false;
    protected $fillable = [
    
        'name',
        'typep_id' ,
        'user_id' // Ajoutez d'autres attributs au besoin
    ];

    // Définir la relation avec le modèle Typep
    public function typep()
    {
        return $this->belongsTo(Typep::class, 'typep_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    
}
