@extends('backend.layouts.app')

@section('PageTitle', 'Demandes de Panne')

@section('content')
    <!-- Afficher les demandes de panne du client connecté -->
    
    <div class="card">
      <div class="card-body">
          <div class="table-responsive">
              <table id="data_table" class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th>Nom de client </th>
                          <th>marque </th>
                          <th>Nom de la panne</th>
                          <th>Catégorie</th>
                          <th>Détails de la panne</th>
                          <th>Actions</th>
                          <th>Actions</th>
                          <th>Actions</th>
                          <th>Actions</th>
                          <th>Actions</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                    <tbody>
                        @foreach($rendezvous as $rdv)
                            <tr>
                                <td>{{ $rdv->nom }}</td>
                                <td>{{ $rdv->Marque }}</td>
                                <td>{{ $rdv->catégorie }}</td>
                                <td>{{ $rdv->panne }}</td>
                                <td>{{ $rdv->problème }}</td>
                                <td>{{ $rdv->problème }}</td>
                                <td>{{ $rdv->problème }}</td>
                                <td>{{ $rdv->problème }}</td>
                                <td>{{ $rdv->problème }}</td>
                                <td>
                                  <div class="d-flex order-actions">
                                    <!-- Bouton avec icône de suppression -->
                                  
                                        <i class='bx bxs-trash'></i>
                                    </a>
                                
                                    <!-- Bouton avec icône de mise à jour -->
                                    
                                        <i class='bx bxs-edit'></i>
                                    </a>
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
