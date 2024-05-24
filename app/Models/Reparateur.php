<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reparateur extends Model
{
    // Autres méthodes et propriétés
    protected $table = 'reparateur';
      use HasFactory;

  
      protected $fillable = [
          'phone_number',
          'address',
          'service_type',
          'short_description',
          'user_id',
      ];
    /**
     * Get the user that owns the reparateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
