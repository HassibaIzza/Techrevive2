<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{

    public $timestamps = false;

    use HasFactory;
    protected $fillable = [
        'id', 'name','gmail', // Ajoutez d'autres colonnes au besoin
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function owner()
{
    return $this->belongsTo(User::class, 'owner_id');
}
}
