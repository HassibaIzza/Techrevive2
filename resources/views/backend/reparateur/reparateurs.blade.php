
<style>
  .reparateurs-list {
    list-style: none;
    padding: 0;
}

.reparateur-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ccc;
    transition: background-color 0.3s;
}

.reparateur-item:hover {
    background-color: #f0f0f0; /* Change la couleur au survol */
}

.profile-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #ccc;
    margin-right: 10px;
}

.reparateur-name {
    flex: 1; /* Pour que le nom occupe tout l'espace restant */
}

.stars {
    color: gold;
}
.container {
    display: flex;
    justify-content: first baseline;
}



  </style>
@extends('Layout.master')

@section('title')
Liste des Réparateurs    
@endsection

@section('content')
<div class="container-fluid">
    <section class="breadcrumb-section set-bg" data-setbg="img/bg-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>TEchRevive Réparation</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Liste de Réparateurs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Liste des réparateurs -->
    <ul class="reparateurs-list">
        @foreach ($reparateurs as $reparateur)
        
            <li class="reparateur-item">
                <div class="profile-icon">
                    <!-- Afficher la photo de profil -->
                    @if($reparateur->photo)
                        <img src="{{ asset('uploads/images/profile/' . $reparateur->photo) }}" alt="Photo de profil" class="img-fluid rounded-circle">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Photo de profil par défaut" class="img-fluid rounded-circle">
                    @endif
                </div>
                <div class="reparateur-details">
                    <!-- Afficher le nom du réparateur -->
                    <h4>  {{ $reparateur->name }}</h4>
                    <span class="stars">
                      ★★★★☆
                  </span>
                    <h6> {{ $reparateur->service_type }}</h6>
                    <a href="{{ route('reparateur.showProfile', ['id' => $reparateur->id]) }}" class="reparateur-link">
                      Voir le C.V 
                  </a>
                  
                  
                    <!-- Afficher le type de service -->
                    
                </div>
              </li>
                <!-- Afficher les étoiles -->
              

                
            
        @endforeach
    </ul>
    <!-- End Liste des réparateurs -->
</div>
@endsection


