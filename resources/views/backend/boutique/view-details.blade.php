@php 
use App\Models\Product\ProductModel;
use App\Http\Controllers\ProductController;
use App\Models\BrandModel;
use App\Models\product\ProductImagesModel; 


@endphp
@extends('layout.master')

@section('title')
    view-detaills
@endsection

@section('content')




<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="{{ asset('uploads/images/product/' . $product->product_thumbnail) }}" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        {{--  @php $images = ProductImagesModel::where('image_product_id', '=', $product->product_id)->get('product_image') @endphp--}}
                            @php $productid = $product->product_id ;
                            $images = ProductController::getProductImages($productid);
                            //dd($images);
                            @endphp
                                @foreach ($images as $image)
                                    <img  data-imgbigurl="{{url('uploads/images/product/'.$image->product_image)}}"  src="{{url('uploads/images/product/'.$image->product_image)}}" width="70"class="border rounded cursor-pointer" alt="">
                            @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>Détaills Du Produit</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price"> {{$product->product_price}} DZD </div>
                    <p>{{ $product->product_short_description }}</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">ADD TO CARD</a>                
                    <a href="#" class="heart-icon"><i class="fa {{ $product->is_favorite ? 'fa-heart favorite' : 'fa-heart-o' }}" id="favorite-icon-{{ $product->product_id }}" onclick="toggleFavorite({{ $product->product_id }})"></i></a>
                    <ul>
                        <li><b>Disponibilité</b> <span> {{$product->product_quantity}}</span></li>
                        <li><b>Code produit</b> <span> {{$product->product_code}}</span></li>
                        <li><b>Couleurs</b>        
                            <div class="color-indigators d-flex align-items-center gap-2" >
                                @php $colors = ProductController::getProductSeparatedColors($product->product_colors) @endphp
                                @foreach($colors as $color)
                                    <div class="color-indigator-item" style="background-color:{{$color}}" >
                                    </div>
                                @endforeach
                            </div>

                        </li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>{{$product->product_long_description}}.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>{{$product->product_short_description}}.</p>
                                <p></p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


