
@php
use App\Models\Product\ProductModel;
$products->each(function ($product) {
            $product->is_favorite = $product->isFavorite();
        });
@endphp
@foreach($products as $product)
@if($product->product_status)
<div class="col-lg-4 col-md-6 col-sm-6 ">
    <div class="product__item">
        <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/images/product/' . $product->product_thumbnail) }}">
            <ul class="product__item__pic__hover">
                <li><a href="#"><i class="fa {{ $product->is_favorite ? 'fa-heart favorite' : 'fa-heart-o' }}" id="favorite-icon-{{ $product->product_id }}" onclick="toggleFavorite({{ $product->product_id }})"></i></a></li>
                <li><a href="{{ route('view-details', ['product_id' => $product->product_id]) }}"><i class="fa fa-info-circle"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart"  id="cart-icon-{{ $product->product_id }}" onclick="addToCart({{ $product->product_id }})"></i></a></li>                            

            </ul>
        </div>
        <div class="product__item__text">
            <h6><a href="{{ route('view-details', ['product_id' => $product->product_id]) }}">{{ $product->product_name }}</a></h6>
            <h5>{{ $product->product_price }} DA</h5>
        </div>
    </div>
</div>
@endif
@endforeach