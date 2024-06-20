<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reparateur extends Model
{
    use HasFactory;

    protected $table = 'reparateur';

    protected $fillable = [
        'phone_number',
        'address',
        'service_type',
        'short_description',
        'user_id',
        'commentaire', // Ajoutez ce champ
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}