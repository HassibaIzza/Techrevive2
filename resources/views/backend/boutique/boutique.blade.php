@php
use App\Models\Product\ProductModel;
use App\Http\Controllers\ProductController;
use App\Models\BrandModel;
use App\Models\CouponModel; 
use App\Models\CategoryModel; 
$products = ProductModel::with('images')->paginate(6);
$products->each(function ($product) {
            $product->is_favorite = $product->isFavorite();
        });
$brands = BrandModel::all();
$categories = CategoryModel::all();
$coupons = CouponModel::all(); 
$productPromo = ProductModel::whereHas('vendorCoupons')->with('vendorCoupons')->get();
$newProducts = ProductModel::orderBy('created_at', 'desc')->take(6)->get();
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
                        <span>Marques</span>
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
                        <form action="{{ route('search') }}" method="GET">
                            <div class="hero__search__categories">
                                Tous Categories
                                <i class="fa fa-caret-down" aria-hidden="true"></i>
                            </div>
                            <input type="text" name="query" placeholder="vous cherchez à quoi?">
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


    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Recherche</h4>
                            <ul>
                                
                            </ul>
                        </div>
                        <form method="GET" action="" id="filterForm">
                            <div class="sidebar__item">
                                <h4>Prix</h4>
                                <div class="price-range-wrap">
                                    <div id="slider-range" class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10000" data-max="300000">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    </div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" name="min_price" id="minamount" readonly>
                                            <input type="text" name="max_price" id="maxamount" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__item sidebar__item__color--option">
                                <h4>Marques</h4>
                                @foreach($brands as $brand)
                                    <div class="sidebar__item__color sidebar__item__color--{{ strtolower($brand->brand_name) }}">
                                        <input type="radio" name="brand" id="brand-{{ $brand->brand_id }}" value="{{ $brand->brand_id }}"> {{ $brand->brand_name }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="sidebar__item">
                                <h4>Catégories</h4>
                                <div class="sidebar__item__size">
                                    @foreach($categories as $category)
                                        <div class="sidebar__item__color sidebar__item__color--{{ strtolower($category->category_name) }}">
                                            <input type="radio" name="category" id="category-{{ $category->category_id }}" value="{{ $category->category_id }}"> {{ $category->category_name }}
                                        </div>
                                    @endforeach
                                </div>       
                            </div>
                            <button type="submit" id="filterBtn" class="primary-btn">Filtrer</button>
                        </form>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Nouveaux</h4>
                                <div class="latest-product__slider owl-carousel">
                                    @foreach($newProducts->chunk(3) as $productChunk)
                                            <div class="latest-prdouct__slider__item">
                                                @foreach($productChunk as $product)
                                                    <a href="{{ route('view-details', ['product_id' => $product->product_id]) }}" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img src="{{ asset('uploads/images/product/' . $product->product_thumbnail) }}" alt="{{ $product->product_name }}">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6>{{ $product->product_name }}</h6>
                                                            <span>{{ number_format($product->product_price, 2) }} din DZD</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount" >
                        <div class="section-title product__discount__title">
                            <h2>solder</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach($productPromo as $promo)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{ asset('uploads/images/product/' . $promo->product_thumbnail) }}">
                                            @foreach($promo->vendorCoupons as $coupon)
                                            <div class="product__discount__percent">-{{ $coupon->discount_amount }}%</div>
                                            @endforeach
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa {{ $promo->is_favorite ? 'fa-heart favorite' : 'fa-heart-o' }}" id="favorite-icon-{{ $promo->product_id }}" onclick="toggleFavorite({{ $product->product_id }})"></i></a></li>                            
                                                <li><a href="{{ route('view-details', ['product_id' => $promo->product_id]) }}"><i class="fa fa-info-circle"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"  id="cart-icon-{{ $promo->product_id }}" onclick="addToCart({{ $promo->product_id }})"></i></a></li>                            
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span> {{$promo->product_name}} </span>
                                            <h5><a href="#">{{$promo->product_name}}</a></h5>
                                            <div class="product__item__price">{{$promo->product_price - ($promo->product_price * ($coupon->discount_amount)/100)}} <span style="color: crimson">{{$promo->product_price}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                    
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Filter par</span>
                                    <select  id="brandFilter">
                                        <option value="#">Tous</option>
                                        @foreach($brands as $brand)
                                        <option  value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    
                                    <h6><span id="productcount"> {{ $products->count() }} </span> Produits trouvé </h6>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row" id="product-list">
                        @foreach($products as $product)
                        @if($product->product_status)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/images/product/' . $product->product_thumbnail) }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa {{ $product->is_favorite ? 'fa-heart favorite' : 'fa-heart-o' }}" id="favorite-icon-{{ $product->product_id }}" onclick="toggleFavorite({{ $product->product_id }})"></i></a></li>
                                        <li><a href="{{ route('view-details', ['product_id' => $product->product_id]) }}"><i class="fa fa-info-circle"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart" id="cart-icon-{{ $product->product_id }}" onclick="addToCart({{ $product->product_id }})"></i></a></li>
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
                    </div>
                    <div class="product__pagination">
                        @if ($products->hasPages())
                        <ul>
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <li class="disabled" aria-disabled="true"><span><i class="fa fa-long-arrow-left"></i></span></li>
                            @else
                                <li><a href="{{ $products->previousPageUrl() }}" rel="prev"><i class="fa fa-long-arrow-left"></i></a></li>
                            @endif
                
                            {{-- Pagination Elements --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                
                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}" rel="next"><i class="fa fa-long-arrow-right"></i></a></li>
                            @else
                                <li class="disabled" aria-disabled="true"><span><i class="fa fa-long-arrow-right"></i></span></li>
                            @endif
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</div>



@endsection

@section('ajaxsection')

<script>
/*$(document).ready(function() {
    // Initialisation du slider de prix
    console.log('Initialisation du slider');
    $("#slider-range").slider({
        range: true,
        min: parseInt($("#slider-range").data('min')),
        max: parseInt($("#slider-range").data('max')),
        values: [parseInt($("#slider-range").data('min')), parseInt($("#slider-range").data('max'))],
        slide: function(event, ui) {
            $("#minamount").val(ui.values[0]);
            $("#maxamount").val(ui.values[1]);
        }
    });

    // Définir les valeurs initiales des champs de texte
    $("#minamount").val($("#slider-range").slider("values", 0));
    $("#maxamount").val($("#slider-range").slider("values", 1));

    // Gestion du clic sur le bouton de filtrage
    $('#filterForm').on('submit', function(event) {
        event.preventDefault();

        var minPrice = $("#minamount").val().replace(/[^0-9]/g, '');
        var maxPrice = $("#maxamount").val().replace(/[^0-9]/g, '');
        var selectedBrand = $('input[name="brand"]:checked').val();
        var selectedCategory = $('input[name="category"]:checked').val();

        // Appel AJAX pour filtrer les produits par marque et prix
        $.ajax({
            url: $(this).attr('action'),
            method: 'GET',
            data: {
                brand: selectedBrand,
                category: selectedCategory,
                min_price: minPrice,
                max_price: maxPrice
            },
            success: function(response) {
                console.log('Réponse reçue:', response);
                // Mettre à jour la liste des produits avec les résultats filtrés
                $('#product-list').html(response);
                // Réexécuter le script setBgImages si nécessaire
                setBgImages();
                // Mettre à jour l'URL sans recharger la page
                history.pushState(null, '', $(this).attr('action') + '?' + $.param({
                    brand: selectedBrand,
                    category: selectedCategory,
                    min_price: minPrice,
                    max_price: maxPrice
                }));
            },
            error: function(error) {
                console.error('Erreur lors de la récupération des produits filtrés:', error);
            }
        });
    });

    // Fonction pour définir les images de fond
    function setBgImages() {
        $('.set-bg').each(function() {
            var bg = $(this).data('setbg');
            $(this).css('background-image', 'url(' + bg + ')');
        });
    }

    // Exécuter setBgImages lors du chargement initial
    setBgImages();
});*/




    /**********************************filtrage par prix ******************************************************/
    $(function() {
    // Initialiser le slider
    console.log('Initialisation du slider');
    $("#slider-range").slider({
        range: true,
        min: parseInt($("#slider-range").data('min')),
        max: parseInt($("#slider-range").data('max')),
        values: [parseInt($("#slider-range").data('min')), parseInt($("#slider-range").data('max'))],
        slide: function(event, ui) {
            $("#minamount").val(ui.values[0]);
            $("#maxamount").val(ui.values[1]);
        }
    });
    
}); 
// Définir les valeurs initiales des champs de texte
    $("#minamount").val($("#slider-range").slider("values", 0));
    $("#maxamount").val($("#slider-range").slider("values", 1));


    $("#filterBtn").on('click', function(event) {
    event.preventDefault(); // Empêche le rechargement de la page
    
    var minPrice = $("#minamount").val().replace(/[^0-9]/g, '');
    var maxPrice = $("#maxamount").val().replace(/[^0-9]/g, '');
    var selectedBrand = $('input[name="brand"]:checked').val();
    var selectedCategory = $('input[name="category"]:checked').val();

    console.log('Bouton de filtrage cliqué');
    console.log('Min Price:', minPrice);
    console.log('Max Price:', maxPrice);

    // Appel AJAX pour filtrer les articles
    $.ajax({
        url: '/filter-products', // URL du route pour filtrer les produits
        method: 'GET',
        data: {
            min_price: minPrice,
            max_price: maxPrice ,
            brand :selectedBrand,
            category:selectedCategory,
        },
        success: function(response) {
            console.log('Réponse reçue:', response);
            // Mettre à jour la liste des articles avec les résultats filtrés
            $("#product-list").html(response);
            $('#productcount').text(response.productCount);
            //reexécuté le script setbg 
            setBgImages();
        },
        error: function(error) {
            console.error('Erreur lors de la récupération des produits filtrés:', error);
        }
    });
});
    function setBgImages() {
        // Sélectionnez tous les éléments avec la classe set-bg
        $('.set-bg').each(function() {
            var bg = $(this).data('setbg');
            $(this).css('background-image', 'url(' + bg + ')');
        });
    }

    // Exécutez setBgImages lors du chargement initial
    $(document).ready(function() {
        setBgImages();
    });
    </script>

@endsection










