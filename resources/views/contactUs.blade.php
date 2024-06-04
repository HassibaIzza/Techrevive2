@extends('layout.master')
@section('title')
    Contater-nous
@endsection

@section('content')


<section class="breadcrumb-section set-bg" data-setbg="img/bg-breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>TEchRevive Contact</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Accueil</a>
                        <span>Contactez-Nous</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- contact section --}}
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span ><i class="fa fa-phone" aria-hidden="true"></i></span>
                    <h4>Télephone</h4>
                    <p>+213783195323</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span ><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <h4>Adresse</h4>
                    <p>Chemin des crètes ex INES Mostaganem </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span ><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                    <h4>Temp de Travail</h4>
                    <p>10:00 am to 23:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                    <h4>Email</h4>
                    <p>ThechRevive@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- contact end --}}

{{-- map begin  --}}
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3231.3129681737673!2d0.08378927560808067!3d35.91483875637394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12820209fe20c56b%3A0x5e8633c2989ef5fd!2sFacult%C3%A9%20des%20sciences%20exactes%20et%20de%20l&#39;informatique%20Universit%C3%A9%20de%20Mostaganem%20-%20Site%202%20-%20Zaghloul!5e0!3m2!1sfr!2sdz!4v1716560776728!5m2!1sfr!2sdz"
    width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-inside">
        <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
        <div class="inside-widget">
            <h4>Mostaganem</h4>
            <ul>
                <li>Téléphone: +213783195323</li>
                <li>Add: Chemin des crètes ex INES Mostaganem</li>
            </ul>
        </div>
    </div>
</div></br></br>
{{-- map end  --}}

{{-- contact form begin--}}

<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Envoyer un Message</h2>
                </div>
            </div>
        </div>
        <form action="{{ route('send.contact') }}" method="POST">
            @csrf
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <input name="name" type="text" placeholder="Nom">
                </div>
                <div class="col-lg-6 col-md-6">
                    <input name="email" type="text" placeholder="Email">
                </div>
                <div class="col-lg-12 text-center">
                    <textarea name="content" placeholder="message"></textarea>
                    <button type="submit" class="site-btn">Envoyer message</button>
                </div>
            </div>
            @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
        </form>
    </div>
</div>
{{-- contact form end  --}}

@endsection
