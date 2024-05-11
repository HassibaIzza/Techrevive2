
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

  </style>
@extends('Layout.master')

@section('title')
Liste des Réparateurs    
@endsection

@section('content')
    <div class="container-fluid">
      
        <!-- End Navbar -->

        <!-- Photo avec titre -->
        
      @section('content')
    
<section class="bg-titre-section set-bg" data-setbg="bg-titre.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="bg-titre__text">
                  <h2 style="color: white;">Liste des Réparateurs </h2>
                    <div class="bg-titre__option">
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- your code ... --}}
</section>






        
        <!-- End Photo avec titre -->

        <!-- Liste des réparateurs -->
        <ul class="reparateurs-list">
            @foreach ($reparateurs as $reparateur)
                <li class="reparateur-item">
                    <div class="profile-icon"></div>
                    <!-- Affiche le nom du réparateur -->
                    <span class="reparateur-name">{{ $reparateur->name }}</span>
                    <!-- Affiche les étoiles -->
                    <span class="stars">★★★★★</span>
                </li>
            @endforeach
        </ul>
        <!-- End Liste des réparateurs -->
    </div>
@endsection
@endsection
	
