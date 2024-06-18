@extends('backend.layouts.app')

@section('PageTitle', 'Demandes de Panne')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Demandes récentes</div>

</div>

<!-- Afficher les demandes de panne du client connecté -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">

            <div class="ms-auto" style="margin-bottom: 20px">


                <a href="{{route('send.email')}}" class="btn btn-primary radius-30 mt-2 mt-lg-0">
                    <i class="bx bxs-plus-square"></i> Ajouter une nouvelle demande

                </a>
            </div>
            <table id="data_table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Marque</th>
                        <th>Catégorie</th>
                        <th>Nom de la panne</th>
                        <th>Détails de rendez-vous</th>
                        <th>Etat de réparation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rendezvous as $rdv)
                        <tr>
                            <td>{{ $rdv->nom_marque }}</td>
                            <td>{{ $rdv->nom_catégorie }}</td>
                            <td>{{ $rdv->nom_panne }}</td>
                            <td>
                                @php
                                    $buttonClass = $rdv->date_rendez_vous ? 'btn-success' : 'btn-primary';
                                @endphp
                                <button type="button" class="btn {{ $buttonClass }} btn-sm radius-30 px-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleVerticallycenteredModal-{{ $rdv->id }}">
                                    Voir rendez-vous
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleVerticallycenteredModal-{{ $rdv->id }}"
                                     tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Détails du rendez-vous</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Date de rendez-vous : <span style="font-weight: lighter">{{ $rdv->date_rendez_vous }}</span></h5>
                                                <h5 class="card-title">Note : <span style="font-weight: lighter">{{ $rdv->short_desc }}</span></h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $statusText = '';
                                    $statusClass = '';
                                    if ($rdv->status == 0) {
                                        $statusText = 'En attente';
                                        $statusClass = 'badge bg-danger';
                                    } elseif ($rdv->status == 1) {
                                        $statusText = 'En cours';
                                        $statusClass = 'badge bg-warning';
                                    } elseif ($rdv->status == 2) {
                                        $statusText = 'Terminé';
                                        $statusClass = 'badge bg-success';
                                    }
                                @endphp
                                <span class="{{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                <div class="d-flex order-actions">
                                    <a href="{{ route('demandes.edit', $rdv->id) }}" class="btn btn-primary btn-sm">
                                        <i class='bx bxs-edit'></i>
                                    </a>
                                    <!-- Formulaire de confirmation de suppression -->
                                    <form action="{{ route('demandes.destroy', $rdv->id) }}" method="POST" class="ml-2" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class='bx bxs-trash'></i>
                                        </button>
                                    </form>
                                    <!-- Fin du formulaire de confirmation de suppression -->
                                </div>
                            </td>
                            <!-- Ajoutez d'autres colonnes si nécessaire -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function redirectToRendezvous(id) {
        window.location = "{{ route('rendezvous') }}?id=" + id;
    }
</script>
@endsection
