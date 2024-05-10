<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'mail',
        'marque',
        'catégorie',
        'panne',
        'problème',
        'nom',
        'sujet',
        'client_id'
    ];

    // Define any relationships or custom methods here if needed
}
