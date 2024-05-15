@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Marque;

    // Récupérer le rôle de l'utilisateur connecté
    $role = Auth::user()->role;


  // Récupérer le nom de la marque

  // Récupérer la marque de l'utilisateur connecté
// Récupérer l'ID de l'utilisateur connecté
$userId = Auth::id();

// Récupérer la marque de l'utilisateur connecté en fonction de son ID
$userMarque = Marque::where('owner_id', $userId)->first();

// Vérifier si la marque a été trouvée
if ($userMarque) {
    $marque = $userMarque->name;
} else {
    $marque = 'Marque inconnue';
}




@endphp

@extends('backend.layouts.app')

@section('PageTitle', " $marque ")

@section('content')
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Liste des Pannes {{ $marque }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route($role . '-profile') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $marque }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom de client </th>
                            <th>Nom de la panne</th>
                            <th>Catégorie</th>
                            <th>Détails de la panne</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rendezvous as $panne)
                            <tr>
                             
                                <td>{{ $panne->nom }}</td>
                                <td>{{ $panne->panne }}</td>
                                <td>{{ $panne->catégorie }}</td>
                                 
                                
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm radius-30 px-4"
                                            data-bs-toggle="modal"
                                            data-bs-target="#exampleVerticallycenteredModal-{{$panne->client_id}}">voir les détailles

                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleVerticallycenteredModal-{{$panne->client_id}}"
                                         tabindex="-1"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"> Détails de la panne</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Nom de la panne : <span style="font-weight: lighter">{{$panne->panne}}</span></h5>
                                                    <h5 class="card-title">Problème posé : <span style="font-weight: lighter">{{$panne->problème}}</span></h5>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                          </td>





                          <td>
                          <button type="button" class="btn btn-primary btn-sm radius-30 px-4" onclick="redirectToRendezvous({{ $panne->client_id }})" data-bs-toggle="modal" data-bs-target="rendezvousModal-{{ $panne->client_id }}">
    Rendez-vous
</button>

</td>

        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('plugins')
    <!-- Ajoutez ici les liens vers les fichiers CSS des plugins -->
@endsection

@section('AjaxScript')
    <!-- Ajoutez ici les scripts JavaScript pour les fonctionnalités Ajax -->
@endsection

@section('js')
    <!-- Ajoutez ici vos scripts JavaScript personnalisés -->
    <script>
    function redirectToRendezvous(client_id) {
        window.location = "{{ route('rendezvous') }}?client_id=" + client_id;
    }
</script>

@endsection
