<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status',
        'mail',
        'marque',
        'catégorie',
        'panne',
        'problème',
        'nom',
        'sujet',
        'client_id',
        'user_id',
        'date_rendezvous',
        'short_desc'

    ];

    const STATUS_EN_ATTENTE = 0;
    const STATUS_EN_COURS = 1;
    const STATUS_REPARATION_TERMINEE = 2;

    public static function getStatusOptions()
    {
        return [
            self::STATUS_EN_ATTENTE => 'En attente',
            self::STATUS_EN_COURS => 'En cours',
            self::STATUS_REPARATION_TERMINEE => 'Réparation terminée',
        ];
    }

    // Spécifiez la colonne utilisée pour la relation avec la marque
    public function marque()
    {
        return $this->belongsTo(Marque::class, 'marque', 'name');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
