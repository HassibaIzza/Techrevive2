@if(Auth::user())
@php
$user = Auth::user();
        $favoriteCount = $user->favorites()->count();
        $cartCount = $user->panier()->count();
@endphp
@endif
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('backend_assets')}}/images/" type="image/png" />

    <title>@yield('title', 'Unknown Page')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('style')

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="./index.html" class="navbar-brand" id="logo" style="font-family: 'Merriweather', serif"><span id="span1">T</span>Ech<span>Revive</span>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{ route('show.favorite') }}"><i class="fa fa-heart"></i> <span id="favorite-count">@if(Auth::user()) {{$favoriteCount}} @endif</span></a></li>
                <li><a href="{{route('cart.view')}}"><i class="fa fa-shopping-bag"></i> <span id="cart-count">@if(Auth::user()) {{$cartCount}} @endif</span></a></li>
            </ul>
            <div class="header__cart__price"><span></span></div>
        </div>
        <div class="humberger__menu__widget">
            
            <div class="header__top__right__auth">
                <a href="{{ url('/login') }}"><i class="fa fa-user"></i>Se Connecter</a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.html">Accueil</a></li>
                <li><a href="/boutique">boutique</a></li>
                <li><a href="#">Réparation</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Réparer</a></li>
                        <li><a href="{{route('reparateurs.index')}}">Contacter Réparateur</a></li>
                        <li><a href="{{route('send.email')}}">Contacter SAV</a></li>
                    </ul>
                </li>
                <li><a href="{{route('blogs.index')}}">Blog</a></li>
                <li><a href="{{route('contactUs')}}">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> techRevive@gmail.com</li>
                <li>  Appareils reconditionnés testés  </li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> techrevive@gmail.com</li>
                                <li> Appareils reconditionnés testés    </li>
                    
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            
                            <div class="header__top__right__auth">
                                @if(Auth::check())
                                    <a href="{{ route('logout') }}"><i class="fa fa-user"></i>Se Déconnecter</a>
                                @else
                                    <a href="{{ route('login') }}"><i class="fa fa-user"></i>Se Connecter</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">

                        <a href="./index.html" class="navbar-brand" id="logo" style="font-family: 'Merriweather', serif"><span id="span1">T</span>Ech<span>Revive</span>
                    </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.html">Accueil</a></li>
                            <li class=""><a href="{{route('boutique')}}">Boutique</a></li>
                            <li><a href="#">Réparer</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Réparer</a></li>
                                    <li><a href="{{route('reparateurs.index')}}">Contacter Répateur</a></li>
                                    <li><a href="{{route('send.email')}}">Contacter SAV</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('blogs.index')}}">Blog</a></li>
                            <li><a href="{{route('contactUs')}}">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 ">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{ route('show.favorite') }}"><i class="fa fa-heart" ></i> <span id="favorite-count">@if(Auth::user()) {{$favoriteCount}} @endif</span></a></li>
                            <li><a href="{{route('cart.view')}}"><i class="fa fa-shopping-bag" id="cart-count"></i> <span>@if(Auth::user()) {{$cartCount}} @endif</span></a></li>
                        </ul>
                        <div class="header__cart__price"><span></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

@yield('content')
    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="header__logo">
                            <a href="./index.html" class="navbar-brand" id="logo" style="font-family: 'Merriweather', serif"><span id="span1">T</span>Ech<span>Revive</span>
                        </a>
                        </div><br><br>
                        <ul>
                            <li>Address: Chemin des crètes ex INES Mostaganem </li>
                            <li>Phone: +213783195323</li>
                            <li>Email: TechRevive@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>liens utiles</h6>
                        <ul>
                            <li><a href="{{route('boutique')}}">Boutique</a></li>
                            <li><a href="#">Réparer</a></li>
                            <li><a href="{{route('send.email')}}">SAV</a></li>
                            <li><a href="{{route('reparateurs.index')}}">List Réparateurs</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">qui nous sommes</a></li>
                            <li><a href="#">Notre Services</a></li>
                            <li><a href="#">Projets</a></li>

                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">témoignages</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Abonnez-vous à notre Newsletter maintenant</h6>
                        <p>Recevez des messages  par e-mail sur notre dernière mise à jour</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Inscrire</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous droits réservés | Ce site est réalisé avec <i class="fa fa-heart" aria-hidden="true"></i> par <a href="" target="_blank">Notre Groupe</a>

                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item." alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/all.js') }}"></script>
    @yield('ajaxsection')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>

        $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        });

        function toggleFavorite(productId) {
            $.ajax({
                url: "{{ route('product.favorite') }}",
                method: 'POST',
                data: { product_id: productId },
                dataType: 'JSON',
                success: function(response) {
                    console.log('Success:', response);
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        });

                        // Mise à jour de l'icône du favori en temps réel
                        const icon = $('#favorite-icon-' + productId);
                        if (icon.hasClass('fa-heart')) {
                        icon.removeClass('fa-heart').removeClass('favorite').addClass('fa-heart-o');
                        $('#favorite-count').text(response.favoriteCount);
                        } else {
                            icon.removeClass('fa-heart-o').addClass('fa-heart').addClass('favorite');
                            $('#favorite-count').text(response.favoriteCount);
                        }
                         // Mise à jour du nombre de favoris
                    $('#favorite-count').text(response.favoriteCount);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to mark product as favorite'
                        });
                    }
                },
                error: function(xhr, status, error) {
                console.error('Error:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Vous devez connectez pour ajouter cette article dans vos favoris !  '
                });
                console.error('Status:', status);
                console.error('Response Text:', xhr.responseText);
                }
            });
        }

        function addToCart(productId) {
            $.ajax({
                url: "{{ route('add-to-cart') }}", 
                method: 'POST',
                data: { product_id: productId },
                dataType: 'JSON',
                success: function(response) {
                    console.log('Success:', response);
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        });
    
                        // Mise à jour de l'icône du panier en temps réel
                        $('#cart-count').text(response.cartCount);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'un probléme est survenu !'
                        });
                    }
        
                },
                error: function(xhr, status, error) {
                console.error('Error:', xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'vous devez connectez pour pouvoir ajouter aux panier! ' 
                });
                console.error('Status:', status);
                console.error('Response Text:', xhr.responseText);
                }
            });
        }
    </script>




</body>

</html>
