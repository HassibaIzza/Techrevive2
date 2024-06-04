@php
use App\Models\Product\ProductModel;
use App\Http\Controllers\ProductController;
use App\Models\BrandModel;
$products = ProductModel::with('images')->get();
$products->each(function ($product) {
            $product->is_favorite = $product->isFavorite();
        });
$brands = BrandModel::all();
@endphp
@extends('layout.master')

@section('title')
    Boutique
@endsection

@section('content')


<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        <li><a href="#">Enie</a></li>
                            <li><a href="#">Iris</a></li>
                          
                            <li><a href="#">Condor</a></li>
                            <li><a href="#">Brandt</a></li>
                            <li><a href="#">Géant</a></li>
                            <li><a href="#">Stream</a></li>
                            <li><a href="#">beko</a></li>
                            
                            <li><a href="#">Starlight</a></li>
                            <li><a href="#">LG</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                Tous Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="vous cherchez à quoi?">
                            <button type="submit" class="site-btn">Recherchez</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+213.783.195.323</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="breadcrumb-section set-bg" data-setbg="img/bg-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>TEchRevive achats</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Accueil</a>
                        <span>Boutique</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <div class="featured__controls">
                <ul>
                    @foreach($brands as $brand)

                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="row featured__filter">
        @foreach($products as $product)
            @if($product->product_status)
            <div class="col-lg-3 col-md-4 col-sm-6 mix oranges {{ strtolower($product->$brand->brand_name ?? '') }}">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('uploads/images/product/' . $product->product_thumbnail) }}">
                        <ul class="featured__item__pic__hover">
                            <li><a href="#"><i class="fa {{ $product->is_favorite ? 'fa-heart favorite' : 'fa-heart-o' }}" id="favorite-icon-{{ $product->product_id }}" onclick="toggleFavorite({{ $product->product_id }})"></i></a></li>
                            <li><a href="{{ route('view-details', ['product_id' => $product->product_id]) }}"><i class="fa fa-info-circle"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"  id="cart-icon-{{ $product->product_id }}" onclick="addToCart({{ $product->product_id }})"></i></a></li>                            

                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <h6><a href="#">{{ $product->product_name }}</a></h6>
                        <h5>{{ $product->product_price }} DA</h5>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

</div>



@endsection

@section('ajaxsection')


@endsection










