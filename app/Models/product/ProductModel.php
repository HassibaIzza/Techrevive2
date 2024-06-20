<?php

namespace App\Models\product;

use App\Models\BrandModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Panier;
use App\Models\SubCategoryModel;
use App\Models\CouponModel ; 


class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $guarded = [];
    public $timestamps = true;

    public function isFavorite()
    {
        return $this->favorites()->where('user_id', Auth::id())->exists();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'product_id', 'product_id');
    }

    public function panier()
    {
        return $this->hasMany(Panier::class, 'product_id', 'product_id');
    }


    public function images()
    {
        return $this->hasMany(ProductImagesModel::class, 'image_product_id');
    }

    public function brand()
    {
        return $this->hasMany(BrandModel::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(SubCategoryModel::class, 'sub_category_id');
    }

    public function vendorCoupons()
    {
        return $this->hasMany(CouponModel::class, 'VendorId', 'vendor_id');
    }
}
