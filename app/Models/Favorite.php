<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\ProductModel;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id'];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'product_id');
    }
}

