@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
@endphp

@if(Auth::user())
    @if(Auth::user()->role)
        @php
            $data = DB::table('users')->where('id', Auth::id())->get()[0];
            $status = Auth::user()->status;
        @endphp
        @extends('backend.layouts.app')

        @section('PageTitle', 'Contacter SAV')

        @section('content')
            <!-- Breadcrumb -->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Ajouter une nouvelle demande </div>


                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item active" aria-current="page">Contacter Service Après Vente </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- End Breadcrumb -->

            <div class="card">
                <div class="card-body">
                    <hr/>
                    <form action="{{ route('send.email') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif




                <div class="form-body mt-4">
                    <div class="row">
                    <div class="col-lg-8">
                    <div class="border border-3 p-4 rounded">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input name="name" type="text" class="form-control" id="nom" value="{{ $data->name }}" required autofocus/>
                            <small style="color: #e20000" class="error" id="name-error"></small>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" value="{{ $data->email }}" required autofocus/>
                            <small style="color: #e20000" class="error" id="email-error"></small>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input class="form-control" name="adresse" type="text" value="{{ $data->address }}" required>
                            <small style="color: #e20000" class="error" id="adresse-error"></small>
                            @error('adresse')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="marque" class="form-label">Marque de Produit</label>
                            <select name="marque" id="marque" class="form-select" required>
                                <option value="">Sélectionner une Marque</option>
                                @if (!empty($marques))
                                    @foreach ($marques as $marque)
                                        <option value="{{ $marque->id }}">{{ $marque->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small style="color: #e20000" class="error" id="marque-error"></small>
                        </div>

                        <div class="mb-3">
                            <label for="state" class="form-label">Catégorie de Produit</label>
                            <select name="typep" id="state" class="form-select" required>
                                <option value="">Sélectionner une catégorie</option>
                            </select>
                            <small style="color: #e20000" class="error" id="catégorie-error"></small>
                        </div>

                        <div class="mb-3">
                            <label for="panne" class="form-label">Nom de la panne</label>
                            <select name="typepanne" id="city" class="form-select" required>
                                <option value="">Sélectionner une panne</option>
                            </select>
                            <small style="color: #e20000" class="error" id="panne-error"></small>
                        </div>

                        <div class="mb-3">
                            <label for="problème" class="form-label">Détails</label>
                            <textarea class="form-control" id="problème" name="content" required></textarea>
                            <small style="color: #e20000" class="error" id="problème-error"></small>
                            @error('problème')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center mt-3">

                        <button type="submit" class="btn btn-primary" style="width: 350px ;height: 50px;">Envoyer</button>
                        </div>
                     </form>
                </div>
            </div>

                </div>
            </div>


            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                 $(document).ready(function() {
                    $("#marque").change(function() {
                        var marque_id = $(this).val();

                        if (marque_id == "") {
                            marque_id = 0;
                        }

                        $.ajax({
                            url: '{{ url("/fetch-states/") }}/' + marque_id,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#state').find('option:not(:first)').remove();
                                $('#city').find('option:not(:first)').remove();

                                if (response['typep'].length > 0) {
                                    $.each(response['typep'], function(key, value) {
                                        $("#state").append("<option value='" + value['id'] + "'>" + value['name'] + "</option>");
                                    });
                                }
                            }
                        });
                    });

                    $("#state").change(function() {
                        var typep_id = $(this).val();

                        if (typep_id == "") {
                            typep_id = 0;
                        }

                        $.ajax({
                            url: '{{ url("/fetch-cities/") }}/' + typep_id,
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#city').find('option:not(:first)').remove();

                                if (response['typepanne'].length > 0) {
                                    $.each(response['typepanne'], function(key, value) {
                                        $("#city").append("<option value='" + value['id'] + "'>" + value['name'] + "</option>");
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
        @endsection


        @else
        @include('auth.login')
    @endif

@else
    @include('auth.login')
@endif
