@php
use App\Models\Product\ProductModel;
use App\Http\Controllers\ProductController;
use App\Models\BrandModel;
use App\Models\product\ProductImagesModel;
use App\Models\Panier;

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
                    <h3>Détail Du Produit</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 avis)</span>
                    </div>
                    <div class="product__details__price"> {{$product->product_price}} DZD </div>
                    <p>{{ $product->product_short_description }}</p> 
                    <form  id="addToCartForm" action="{{route('add-to-cart')}}" method="POST">
                        @csrf <!-- Token CSRF pour sécuriser le formulaire -->
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}"> <!-- ID du produit -->
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input id="cartCount" type="" name="quantity" value="1" min="1" value="{{Panier::where('user_id', Auth::id())->count() }}"> <!-- Champ pour la quantité -->
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="primary-btn">Ajouter au panier</button> <!-- Bouton de soumission -->
                    </form>
                    <div id="successMessage" style="display:none;color:green;">Produit ajouté au panier avec succès</div> <!-- Message de succès -->
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
                        <li><b>Share</b>
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
                                aria-selected="false">Avis <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Infomations sur les produits</h6>
                                <p>{!!$product->product_long_description!!}.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Informations sur les produits</h6>
                                <p>{{$product->product_short_description}}.</p>
                                <p></p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Informations sur les produits</h6>
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

@section('ajaxsection')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addToCartForm').on('submit', function(event) {
            event.preventDefault(); // Empêche le rechargement de la page

            $.ajax({
                url: $(this).attr('action'), // URL du route pour ajouter au panier
                method: $(this).attr('method'), // Méthode HTTP du formulaire
                data: $(this).serialize(), // Sérialise les données du formulaire
                success: function(response) {
                    if(response.success) {
                        $('#successMessage').show().delay(3000).fadeOut(); // Affiche le message de succès
                        // Met à jour le compteur du panier (optionnel)
                        $('#cartCount').text(response.cartCount);
                    } else {
                        alert('Une erreur s\'est produite lors de l\'ajout du produit au panier.');
                    }
                },
                error: function() {
                    alert('Une erreur s\'est produite lors de l\'ajout du produit au panier.');
                }
            });
        });
    });
</script>

@endsection


