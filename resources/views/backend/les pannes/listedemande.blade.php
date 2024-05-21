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
                        
                          <th>marque </th>
                          <th>Nom de la panne</th>
                          <th>Catégorie</th>
                          <th>Détails de la panne</th>
                          <th>Actions</th>
                          <
                      </tr>
                  </thead>
                    <tbody>
                        @foreach($rendezvous as $rdv)
                            <tr>
                              
                                <td>{{ $rdv->Marque}}</td>
                                <td>{{ $rdv->catégorie }}</td>
                                <td>{{ $rdv->panne }}</td>
                                
                                <td>
                                  <button type="button" class="btn btn-primary btn-sm radius-30 px-4"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleVerticallycenteredModal-{{$rdv->id}}">voir les détailles

                                  </button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleVerticallycenteredModal-{{$rdv->id}}"
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
                                                  <h5 class="card-title">Nom de la panne : <span style="font-weight: lighter">{{$rdv->panne}}</span></h5>
                                                  <h5 class="card-title">Problème posé : <span style="font-weight: lighter">{{$rdv->problème}}</span></h5>
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
@section('js')
    <!-- Ajoutez ici vos scripts JavaScript personnalisés -->
    <script>
    function redirectToRendezvous(id) {
        window.location = "{{ route('rendezvous') }}?id=" + id;
    }
</script>
@endsection
