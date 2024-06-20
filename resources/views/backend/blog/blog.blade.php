@php
use App\Models\Blog; 
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




<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
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
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        @foreach ($blogs as $blog)
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('uploads/images/blog_images/' . $blog->image) }}" alt="{{$blog->title}}">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> {{$blog->created_at }} </li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="{{ route('lire-plus', ['id' => $blog->id]) }}"> {{$blog->title}} </a></h5>
                                <p> {!! Str::limit($blog->content, 200) !!} </p>
                                <a href="{{ route('lire-plus', ['id' => $blog->id]) }}" class="blog__btn">lire plus <span class="arrow_right"></span></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            @if ($blog->hasPages())
                            <ul>
                                {{-- Previous Page Link --}}
                                @if ($blog->onFirstPage())
                                    <li class="disabled" aria-disabled="true"><span><i class="fa fa-long-arrow-left"></i></span></li>
                                @else
                                    <li><a href="{{ $blog->previousPageUrl() }}" rel="prev"><i class="fa fa-long-arrow-left"></i></a></li>
                                @endif
                    
                                {{-- Pagination Elements --}}
                                @foreach ($blog->getUrlRange(1, $blog->lastPage()) as $page => $url)
                                    @if ($page == $blog->currentPage())
                                        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                    
                                {{-- Next Page Link --}}
                                @if ($blog->hasMorePages())
                                    <li><a href="{{ $blog->nextPageUrl() }}" rel="next"><i class="fa fa-long-arrow-right"></i></a></li>
                                @else
                                    <li class="disabled" aria-disabled="true"><span><i class="fa fa-long-arrow-right"></i></span></li>
                                @endif
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection