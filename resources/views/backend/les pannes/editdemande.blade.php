@extends('backend.layouts.app')

@section('PageTitle', 'Modifier la Demande de Panne')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Modifier la Demande</div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('demandes.update', $rendezvous->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom de client</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $rendezvous->nom }}" required>
            </div>
            <div class="mb-3">
                <label for="marque" class="form-label">Marque</label>
                <select name="marque" id="marque" class="form-control" required>
                    <option value="">Sélectionner une marque</option>
                    @foreach ($marques as $marque)
                        <option value="{{ $marque->id }}" @if ($rendezvous->marque == $marque->id) selected @endif>{{ $marque->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="catégorie" class="form-label">Catégorie</label>
                <select name="catégorie" id="catégorie" class="form-control" required>
                    <option value="">Sélectionner une catégorie</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}" @if ($rendezvous->catégorie == $categorie->id) selected @endif>{{ $categorie->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="panne" class="form-label">Nom de la panne</label>
                <select name="panne" id="panne" class="form-control" required>
                    <option value="">Sélectionner une panne</option>
                    @foreach ($pannes as $panne)
                        <option value="{{ $panne->name }}" @if ($rendezvous->panne == $panne->id) selected @endif>{{ $panne->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="problème" class="form-label">Détails de la panne</label>
                <textarea class="form-control" id="problème" name="problème" required>{{ $rendezvous->problème }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#marque').change(function() {
            var marqueID = $(this).val();
            if (marqueID) {
                $.ajax({
                    url: '/fetch-states/' + marqueID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#catégorie').empty();
                        $('#catégorie').append('<option value="">Sélectionner une catégorie</option>'); 
                        $.each(data.typep, function(key, value) {
                            $('#catégorie').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#catégorie').empty();
                $('#catégorie').append('<option value="">Sélectionner une catégorie</option>'); 
            }
        });

        $('#catégorie').change(function() {
            var typepID = $(this).val();
            if (typepID) {
                $.ajax({
                    url: '/fetch-cities/' + typepID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#panne').empty();
                        $('#panne').append('<option value="">Sélectionner une panne</option>'); 
                        $.each(data.typepannes, function(key, value) {
                            $('#panne').append('<option value="'+ value +'">'+ value +'</option>');
                        });
                    }
                });
            } else {
                $('#panne').empty();
                $('#panne').append('<option value="">Sélectionner une panne</option>'); 
            }
        });
    });
</script>
@endsection
