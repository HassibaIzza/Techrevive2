@php
use App\MyHelpers;
use Illuminate\Support\Facades\Auth;
@endphp
@extends('backend.layouts.app')
@section('PageTitle', 'Vendors')
@section('content')
    <!--breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Utilisateurs</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="dashboard"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Liste des utilisateurs</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Date d'inscription</th>
                        <th>Statut</th>
                        <th>Détails</th>
                        <th>Activer</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{MyHelpers::getDiffOfDate($item->created_at)}}</td>
                            {{--                            <td>{{$item->status}}</td>--}}
                            <td>
                                @if($item->status)
                                    <div class="badge rounded-pill bg-light-success text-success w-100">Actif</div>
                                @else
                                    <div class="badge rounded-pill bg-light-danger text-danger w-100">Inactif</div>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm radius-30 px-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleVerticallycenteredModal-{{$item->id}}">Voir les détails

                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleVerticallycenteredModal-{{$item->id}}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Détails de l'utilisateur</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{url('uploads/images/profile/' . $item->photo)}}"
                                                     class="card-img-top" style="max-width: 300px; margin-left:
                                                         10px">
                                                <div class="card-body">
                                                    <h5 class="card-title">Nom : <span style="font-weight:
                                                         lighter">{{$item->name}}</span>
                                                    </h5>
                                                    <h5 class="card-title">Email : <span style="font-weight:
                                                         lighter">{{$item->email}}</span>
                                                    </h5>
                                                    <h5 class="card-title">Nom d'utilisateur : <span style="font-weight:
                                                         lighter">{{$item->username}}</span>
                                                    </h5>
                                                    <h5 class="card-title">Addresse : <span style="font-weight:
                                                         lighter">{{$item->address ?  : 'No address
                                                         '}}</span>
                                                    </h5>
                                                    <h5 class="card-title">Numéro de téléphone : <span style="font-weight:
                                                         lighter">{{$item->phone_number ? : 'No phone number'}}</span>
                                                    </h5>
                                                    <h5 class="card-title">Role : <span style="font-weight:
                                                        lighter">{{$item->role
                                                        ? : 'No phone number'}}</span>
                                                   </h5>
                                                    <h5 class="card-title">Statut : <span style="font-weight:
                                                         lighter">
                                                            @if($item->status)
                                                                <span style="color: lime">Actif</span>
                                                            @else
                                                                <span style="color: red">Inactif</span>
                                                            @endif
                                                        </span>
                                                    </h5>
                                                </div>
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
                                <form method="POST" action="{{route('admin-activate-vendor')}}"
                                      class="active-deactive-form">
                                    @csrf
                                    <input name="vendor_id" value="{{$item->id}}" hidden/>
                                    <input name="current_status" value="{{$item->status}}" hidden/>
                                    <div class="form-check form-switch">
                                        @if($item->status)
                                            <input name="de_activate" class="btn
                                            btn-outline-danger" type="submit"
                                                   value="Désactiver">
                                        @else
                                            <input name="activate" class="btn
                                            btn-outline-success" type="submit" style=" width: 110px;"
                                                   value=" Activer ">
                                        @endif

                                    </div>
                                </form>
                            </td>
                            <td>
                                <a href="" class="ms-3" data-bs-toggle="modal"
                                data-bs-target="#exampleDangerModal-{{$item->id}}">
                                <i class='bx bxs-trash'></i>
                            </a>
                            <div class="modal fade" id="exampleDangerModal-{{$item->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">Surement ?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                                            <form id="delete-form-{{$item->id}}" action="{{ route('vendor-remove', $item->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('POST') <!-- Laravel utilise POST pour supprimer ici -->
                                            </form>
                                            <button onclick="document.getElementById('delete-form-{{$item->id}}').submit();" class="btn btn-dark">Confirmer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </td>
                        </tr>

                    @endforeach

                </table>
            </div>
        </div>
    </div>
@endsection
@section('plugins')
    <link href="{{asset('backend_assets')}}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
@endsection
@section('js')
    <script src="{{asset('backend_assets')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend_assets')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#data_table').DataTable({
                lengthChange: true,
                buttons: ['excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#data_table_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script src="sweetalert2.all.min.js"></script>



    @section('AjaxScript')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"
                integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    @endsection

    @section('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#brand_image').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#show_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('form.active-deactive-form').click('submit', function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{route('admin-activate-vendor')}}",
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: response.msg,
                                showDenyButton: false,
                                showCancelButton: false,
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                window.location.reload();
                            });
                        },
                        error: function (response) {

                        }
                    });
                });
            });
        </script>
    @endsection
@endsection
