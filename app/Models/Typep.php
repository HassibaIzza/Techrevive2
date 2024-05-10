<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;







class Typep extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'marque_id', // Ajoutez d'autres colonnes au besoin
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }
}

