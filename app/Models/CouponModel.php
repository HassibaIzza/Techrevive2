<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product\ProductModel ; 

class CouponModel extends Model
{
    use HasFactory;
    protected $table = 'coupon';
    protected $primaryKey = 'coupon_id';
    protected $guarded = [];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(ProductModel::class, 'vendor_id', 'VendorId');
    }

}

