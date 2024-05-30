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
                              <th>Catégorie</th>
                              <th>Nom de la panne</th>
                              <th>Détails de rendez vous</th>
                              <th>Actions</th>
                          <
                      </tr>
                  </thead>
                    <tbody>
                        @foreach($rendezvous as $rdv)
                            <tr>
                              
                                <td>{{ $rdv->nom_marque}}</td>
                                <td>{{ $rdv->nom_catégorie }}</td>
                                <td>{{ $rdv->nom_panne }}</td>
                                
                                <td>
                                  <button type="button" class="btn btn-primary btn-sm radius-30 px-4"
                                          data-bs-toggle="modal"
                                          data-bs-target="#exampleVerticallycenteredModal-{{$rdv->id}}">voir rendez_vous

                                  </button>
                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleVerticallycenteredModal-{{$rdv->id}}"
                                       tabindex="-1"
                                       aria-hidden="true">
                                      <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">date de rend vous</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                          aria-label="Close"></button>
                                              </div>
                                              <div class="card-body">
                                                  <h5 class="card-title">date de rendez vous : <span style="font-weight: lighter">{{$rdv->date_rendez_vous}}</span></h5>
                                                  <h5 class="card-title"> note: <span style="font-weight: lighter">{{$rdv->short_desc}}</span></h5>
                                              </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                  Close
                                              </button>
                                          </div>
                                      </div>
                                  </div>


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
    <!-- Ajoutez ici vos scripts JavaScript personnalisés -->
    <script>
    function redirectToRendezvous(id) {
        window.location = "{{ route('rendezvous') }}?id=" + id;
    }
</script>
@endsection
