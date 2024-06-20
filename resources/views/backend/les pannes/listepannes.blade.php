@php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Marque;

    // Récupérer le rôle de l'utilisateur connecté
    $role = Auth::user()->role;

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

@section('PageTitle', "$marque")

@section('content')
<!-- Breadcrumb -->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Liste des Pannes {{ $marque }}</div>
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

<div class="mb-3">
    <label for="categorieFilter" class="form-label">Filtrer par catégorie</label>
    <select class="form-select" id="categorieFilter">
        <option value="">Toutes les catégories</option>
        @foreach($categories as $categorie)
            <option value="{{ $categorie }}">{{ $categorie }}</option>
        @endforeach
    </select>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="data_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nom de client</th>
                        <th>Nom de la panne</th>
                        <th>Catégorie</th>
                        <th>Status</th>
                        <th>Détails de la panne</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($rendezvous as $panne)
                    <tr>

                            <td>{{ $panne->nom }}</td>
                            <td>{{ $panne->nom_panne }}</td>
                            <td>{{ $panne->nom_catégorie }}</td>
                            <td>
    <form action="{{ route('pannes.updateStatus', $panne->id) }}" method="post">
        @csrf
        @method('patch')
        <select name="status" class="status-select {{ $panne->status == 1 ? 'status-en-cours' : ($panne->status == 2 ? 'status-termine' : 'status-attente') }}" style="border-radius: 30px;" onchange="this.form.submit()">
            @foreach(\App\Models\RendezVous::getStatusOptions() as $value => $label)
                <option value="{{ $value }}" {{ $panne->status == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </form>
</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#exampleVerticallycenteredModal-{{ $panne->id }}">Voir les détails</button>
                                <div class="modal fade" id="exampleVerticallycenteredModal-{{ $panne->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Détails de la panne</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Nom de la panne : <span style="font-weight: lighter">{{ $panne->nom_panne }}</span></h5>
                                                <h5 class="card-title">Problème posé : <span style="font-weight: lighter">{{ $panne->nom_catégorie }}</span></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
    @if ($panne->date_rendez_vous)
        <button type="button" class="btn btn-success btn-sm radius-30 px-4" onclick="redirectToRendezvous({{ $panne->id }})">Rendez-vous</button>
    @else
        <button type="button" class="btn btn-primary btn-sm radius-30 px-4" onclick="redirectToRendezvous({{ $panne->id }})">Rendez-vous</button>
    @endif
</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>



    .status-select {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
        border-radius: 5px;
        padding: 5px;
        font-size: 14px;
    }
    .status-select option {
        background-color: #007bff;
        color: black;


    }

    .status-en-cours {
    /*background-color:   #ffc107;*/
    color: white;
}

.status-termine {
    background-color: green;
    color: white;
}
.status-attente {
    background-color: red;
    color: white;
}
</style>
@endsection

@section('js')
<script>
function redirectToRendezvous(id) {
    window.location = "{{ route('rendezvous') }}?id=" + id;
}

function filterByCategorie(categorie) {
    var rows = document.querySelectorAll('#data_table tbody tr');
    rows.forEach(function(row) {
        var categorieCell = row.querySelector('td:nth-child(3)');
        var rowCategorie = categorieCell.textContent.trim();
        if (categorie === '' || rowCategorie === categorie) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}
document.addEventListener('DOMContentLoaded', function() {
    var filterSelect = document.getElementById('categorieFilter');
    filterSelect.addEventListener('change', function() {
        filterByCategorie(this.value);
    });
});
</script>
@endsection

