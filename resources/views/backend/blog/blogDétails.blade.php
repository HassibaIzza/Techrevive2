@php
use App\Models\Blog; 
$blogs = Blog::all()->take(3);
$newblogs = Blog::orderBy('created_at', 'desc')->take(3)->get();
@endphp
@extends('Layout.master')

@section('title')
    blog
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
                        <form action="{{route('searchblog')}}" method="GET">
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

<!-- Blog Details Hero Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/bg-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>TEchRevive blog </h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Accueil</a>
                        <span>blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<section class="blog-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5 order-md-1 order-2">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="{{route('searchblog')}}" method="GET">
                            <input name="query" type="text" placeholder="Search...">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></span></button>
                        </form>
                    </div>

                    <div class="blog__sidebar__item">
                        <h4>blogs recents</h4>
                        <div class="blog__sidebar__recent">
                            @foreach($newblogs as $newblog)
                            <a href="{{ route('lire-plus', ['id' => $newblog->id]) }}" class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img src="{{ asset('uploads/images/blog_images/' . $newblog->image) }}" alt="{{$newblog->title}}" width="100px">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6>  {{$newblog->title}} <br /></h6>
                                    <span>{{$newblog->created_at }}</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-8 col-md-7 order-md-1 order-1">
                <div class="blog__details__text">
                    <img src="{{ asset('uploads/images/blog_images/' . $blog->image) }}" alt="">
                    <p>      {!! $blog->content !!}   </p>
                </div>
                <div class="blog__details__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="blog__details__author">
                                <div class="blog__details__author__pic">
                                    <img src="{{ asset('uploads/images/profile/' . $blog->user->photo) }}" alt="{{$blog->title}}">
                                </div>
                                <div class="blog__details__author__text">
                                    <h6> {{$blog->user->name}} </h6>
                                    <span>{{$blog->user->role}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="blog__details__widget">
                                <ul>
                                    <li><span>Categories:</span> Food</li>
                                    <li><span>Tags:</span> All, Trending, Cooking, Healthy Food, Life Style</li>
                                </ul>
                                <div class="blog__details__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<!-- Related Blog Section Begin -->
<section class="related-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related-blog-title">
                    <h2>Posts Vous pourriez aimer</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $blog )
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="{{ asset('uploads/images/blog_images/' . $blog->image) }}" alt="{{$blog->title}}">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i>{{$blog->created_at }}</li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>
                        <h5><a href="{{ route('lire-plus', ['id' => $blog->id]) }}"> {{$blog->title}}</a></h5>
                        <p> {{ Str::limit($blog->content, 200) }} </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>



@endsection