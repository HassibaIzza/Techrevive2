@php 
use App\Models\Product\ProductModel;
use App\Http\Controllers\ProductController;
use App\Models\BrandModel;
$products = ProductModel::with('images')->get();
$brands = BrandModel::all();
@endphp
@extends('layout.master')

@section('title')
    Boutique
@endsection

@section('content')

<section class="breadcrumb-section set-bg" data-setbg="img/bg-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>TEchRevive achats</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
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
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{ route('view-details', ['product_id' => $product->product_id]) }}"><i class="fa fa-info-circle"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
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