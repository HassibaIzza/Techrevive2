@php use App\Http\Controllers\ProductController;use Illuminate\Support\Facades\Auth; $role = Auth::user()->role;@endphp

@extends('backend.layouts.app')
@section('PageTitle', 'Mes Favoris')
@section('content')
    <!--breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Products</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route($role . '-profile')}}"><i class="bx
                    bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Mes Favoris</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb -->

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                
                @endif
                <table id="data_table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($favoris as $item)
                        <tr>
                            <td>{{$item->product_name}}</td>
                            <td>{{$item->product_price}}</td>
                           
                            
                            <td>
                                <div class="d-flex order-actions">
                                    @if(Auth::user()->role == "vendor")
                                        <a href="edit_product/{{$item->product_id}}"><i class='bx bxs-edit'></i>
                                        </a>
                                    @endif


                                    <a href="" class="ms-3" data-bs-toggle="modal"
                                    data-bs-target="#exampleDangerModal-{{$item->product_id}}">

                                        <i class='bx bxs-trash'></i>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleDangerModal-{{$item->product_id}}"
                                             tabindex="-1"
                                             style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content bg-danger">
                                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Cancel
                                                        </button>
                                                        <button onclick="window.location.replace
                                                        ('remove_product/{{$item->product_id}}');"
                                                                class="btn btn-dark">Confirm
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>


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
@section('AjaxScript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
@endsection

@section('js')
    <script src="{{asset('backend_assets')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend_assets')}}/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('form.activate_form').on('submit', function (event) {
                event.preventDefault();
    
                console.log('Form submitted');  // Ajoutez ceci pour déboguer
    
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                        url: "{{route('vendor-product-activate')}}",
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
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

    @section('js')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#product_image').change(function (e) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#show_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files['0']);
                });
            });
        </script>
    @endsection
@endsection
