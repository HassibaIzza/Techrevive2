{{-- comment   @php use Illuminate\Support\Facades\Auth; @endphp
@if(Auth::user())
    @switch(Auth::user()->role)
        @case("vendor")
            @include('backend.profile.vendor_profile')
        @case("admin")
            @include('backend.profile.admin_profile')
    @endswitch

@else
    @include('auth.login')
@endif --}}
@php 
use App\Models\Product\ProductModel;
use App\Http\Controllers\ProductController;
use App\Models\BrandModel;
$products = ProductModel::with('images')->get();
$brands = BrandModel::all();
@endphp
@extends('Layout.master')

@section('title')
    Home
@endsection

@section('content')



    <!-- Hero Section Begin -->
    <section class="hero">
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
                            <form action="#">
                                <div class="hero__search__categories">
                                    tous les produits 
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="de quoi avez-vous besion ?">
                                <button type="submit" class="site-btn">Recherche</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+2137 83 19 53 23 </h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/nr.jfif">
                      <div class="hero__text" style="position: relative;">
                          <div style="background: rgba(0, 0, 0, 0.5); padding: 20px; display: inline-block; text-align: left;">
                              <span style="color: #87CEEB; font-size: 24px;">TechRevive</span>
                              <h2 style="font-family: Arial, sans-serif; color: white;">
                                  <span style="color: #87CEEB; font-size: 36px;">É</span>conomisez<br />protégez, réparez
                              </h2>
                              <a href="#" class="primary-btn">Achetez!</a>
                          </div>
                      </div>
                  </div>
                  
                  
                  
                  </div>
                  
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="section-title ">
                <h2>NOS Partenaires</h2>
            </div>
            <div class="row"> 
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" style="height: 94px; width: 270px;" data-setbg="img/MARQUES/ENIE.png">
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" style="height: 72px; width: 280px;" data-setbg="img/MARQUES/logoBlanc.png">
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" style="height: 86px; width: 260px;" data-setbg="img/MARQUES/logo_blue.png">
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" style="height: 84px; width: 260px;" data-setbg="img/MARQUES/logoo.png">
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" style="height: 73px; width: 260px;"  data-setbg="img/MARQUES/bradndt.png">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>PRODUIT</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li data-filter="*">All</li>
                            @foreach($brands as $brand)
                            <li data-filter=".{{ strtolower($brand->brand_name) }}">{{ $brand->brand_name }}</li>                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges {{ strtolower($product->$brand->brand_name ?? '') }}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ asset('uploads/images/product/' . $product->product_thumbnail) }}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-info-circle"></i></a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="#">{{ $product->product_name }}</a></h6>
                                <h5>{{ $product->product_price }} DZD</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    
    <!-- Featured Section End -->

    <!-- Banner Begin
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Nouveaux Produit</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/CONDOR-600.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Réfrigirateur Condor 600L Blanc</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/MACHINE_A_lAVER.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>machine a laver Condor 8kg Silver 1400 Tr/s</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/55E2G.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Iris Téléviseur LED 55 "55E2G"</h6>
                                        <span>24 000,00 din DZD</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/CONDOR-600.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Réfrigirateur Condor 600L Blanc</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/MACHINE_A_lAVER.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>machine a laver Condor 8kg Silver 1400 Tr/s</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/machine.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>machine a laver Condor 8kg Silver 1400 Tr/s</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produits les mieux notés</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/réfrcondor.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Condor Régrigirateur CRF-NT49ZH05G NO FROST 360L Silver</h6>
                                        <span>70 000,00 din dZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/MACHINE_A_lAVER.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>machine a laver Condor 8kg Silver 1400 Tr/s</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/IRIS-REFRIGERATEUR.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Réfrigirateur Dfrost Couleur Blanche 2 portes Iris bcd 480b</h6>
                                        <span>66 900,00 din DZD</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/MACHINE_A_lAVER.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>machine a laver Condor 8kg Silver 1400 Tr/s</h6>
                                        <span>60 000,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/réfrcondor.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Condor Régrigirateur CRF-NT49ZH05G NO FROST 360L Silver</h6>
                                        <span>70 000,00 din dZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/IRIS-REFRIGERATEUR.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Réfrigirateur Dfrost Couleur Blanche 2 portes Iris bcd 480b</h6>
                                        <span>66 900,00 din DZD</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Produit évaluer</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/images.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Iris TV LED 32 FULL HD Noir -32E30</h6>
                                        <span>24 700,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/65Q.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Iris Téléviseur LED 65 Q 20 UHD Android tv "LED65Q20"</h6>
                                        <span>24 700,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/IRIS-REFRIGERATEUR.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Réfrigirateur Dfrost Couleur Blanche 2 portes Iris bcd 480b</h6>
                                        <span>66 900,00 din DZD</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/images.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Iris TV LED 32 FULL HD Noir -32E30</h6>
                                        <span>24 700,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/65Q.png" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Iris Téléviseur LED 65 Q 20 UHD Android tv "LED65Q20"</h6>
                                        <span>24 700,00 din DZD</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/featured/IRIS-REFRIGERATEUR.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Réfrigirateur Dfrost Couleur Blanche 2 portes Iris bcd 480b</h6>
                                        <span>66 900,00 din DZD</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
    
    
@endsection
    


