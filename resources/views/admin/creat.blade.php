Farah Info, [01/05/2024 21:21]
@php 
$role = Auth::user()->role; 
@endphp 
@extends('backend.layouts.app') 
@section('PageTitle', 'Add new brand') 
@section('content') 
 
    <!--breadcrumb --> 
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="breadcrumb-title pe-3">Booking</div> 
 
        <div class="ps-3"> 
            <nav aria-label="breadcrumb"> 
                <ol class="breadcrumb mb-0 p-0"> 
                    <li class="breadcrumb-item"><a href="{{route($role . '-profile')}}"><i class="bx bx-home-alt"></i></a></li> 
                    <li class="breadcrumb-item active" aria-current="page">Add new booking</li> 
                </ol> 
            </nav> 
        </div> 
    </div> 
 
    <!--end breadcrumb --> 
    <div class="card"> 
        <div class="card-body"> 
 
 
    <!--Boutton t3 Hoooooooooooooooooooooooooooooooooooda--> 
            <div class="card-header py-3 d-flex"> 
                <h1 class="h3 mb-0 text-gray-800">{{ __('create booking') }}</h1> 
                </div> 
            <h4 class="d-flex align-items-center mb-3"></h4> 
            <br> 
 
           <!--Les rooooooooooooooooooooooooote w7da tngl3 --> 
            <form action="{{ route('admin.bookings.store') }}" method="POST"> 
 
 
 
 
                @csrf 
                <div class="row mb-3"> 
                    <div class="col-sm-3"> 
                        <h6 class="mb-0">Brand Name</h6> 
                    </div> 
                    <div class="col-sm-9 text-secondary"> 
                        <input name="brand_name" type="text" class="form-control" required autofocus/> 
                        <small style="color: #e20000" class="error" id="brand_name-error">Add Name</small> 
                    </div> 
                </div> 
 
 
 
                <div class="row mb-3"> 
                    <div class="col-sm-3"> 
                        <h6 class="mb-0">{{ __('Time To') }}</h6> 
                    </div> 
                    <div class="col-sm-9 text-secondary"> 
                        <div class="input-group date" id="datetimepicker_time_to" data-target-input="nearest"> 
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker_time_to" id="time_to" name="time_to" value="{{ old('time_to', $timeTo) }}" required/> 
                            <div class="input-group-append" data-target="#datetimepicker_time_to" data-toggle="datetimepicker"> 
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div> 
                            </div> 
                        </div> 
                        <small style="color: #e20000" class="error" id="time_to-error"></small> 
                    </div> 
                </div> 
 
                <div class="row mb-3"> 
                    <div class="col-sm-3"> 
                        <h6 class="mb-0">{{ __('Short Description') }}</h6> 
                    </div> 
                    <div class="col-sm-9 text-secondary"> 
                        <textarea name="short_description" class="form-control" id="inputShortDescription" rows="3" required>{{ old('short_description') }}</textarea> 
                        <small style="color: #e20000" class="error" id="short_description-error"></small> 
                    </div> 
                </div> 
 
                <div class="row"> 
                    <div class="col-sm-3"></div> 
                    <div class="col-sm-9 text-secondary"> 
                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" /> 
                    </div> 
                </div> 
            </form> 
        </div> 
    </div> 
    </div> 
@endsection 
 
@section('AjaxScript') 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"

Farah Info, [01/05/2024 21:21]
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> 
 
        <!-- Scripts pour le sélecteur de date et d'heure --> 
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 
    <script> 
        $('.datetimepicker').datetimepicker({ 
            format: 'YYYY-MM-DD HH:mm', 
            locale: 'en', 
            sideBySide: true, 
            icons: { 
                up: 'fas fa-chevron-up', 
                down: 'fas fa-chevron-down', 
                previous: 'fas fa-chevron-left', 
                next: 'fas fa-chevron-right' 
            }, 
            stepping: 10 
        }); 
    </script> 
 
 
<script type="text/javascript"> 
        $(document).ready(function(){ 
            $('#brand_form').on('submit', function(event){ 
                event.preventDefault(); 
                // remove errors if the conditions are true 
                $('#brand_form *').filter(':input.is-invalid').each(function(){ 
                    this.classList.remove('is-invalid'); 
                }); 
                $('#brand_form *').filter('.error').each(function(){ 
                    this.innerHTML = ''; 
                }); 
                $.ajax({ 
                    url: "{{route('brand-create')}}", 
                    method: 'POST', 
                    data: new FormData(this), 
                    dataType: 'JSON', 
                    contentType: false, 
                    cache: false, 
                    processData: false, 
                    success : function(response) 
                    { 
                        // remove errors if the conditions are true 
                        $('#brand_form *').filter(':input.is-invalid').each(function(){ 
                            this.classList.remove('is-invalid'); 
                        }); 
                        $('#brand_form *').filter('.error').each(function(){ 
                            this.innerHTML = ''; 
                        }); 
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
                    error: function(response) { 
                        var res = $.parseJSON(response.responseText); 
                        $.each(res.errors, function (key, err){ 
                            $('#' + key + '-error').text(err[0]); 
                            $('#' + key ).addClass('is-invalid'); 
                        }); 
                    } 
                }); 
            }); 
        }); 
    </script> 
@endsection

Farah Info, [01/05/2024 21:21]
@php 
$role = Auth::user()->role; 
@endphp 
@extends('backend.layouts.app') 
@section('PageTitle', 'Add new brand') 
@section('content') 
 
    <!--breadcrumb --> 
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="breadcrumb-title pe-3">Booking</div> 
 
        <div class="ps-3"> 
            <nav aria-label="breadcrumb"> 
                <ol class="breadcrumb mb-0 p-0"> 
                    <li class="breadcrumb-item"><a href="{{route($role . '-profile')}}"><i class="bx bx-home-alt"></i></a></li> 
                    <li class="breadcrumb-item active" aria-current="page">Add new booking</li> 
                </ol> 
            </nav> 
        </div> 
    </div> 
 
    <!--end breadcrumb --> 
    <div class="card"> 
        <div class="card-body"> 
 
 
    <!--Boutton t3 Hoooooooooooooooooooooooooooooooooooda--> 
            <div class="card-header py-3 d-flex"> 
                <h1 class="h3 mb-0 text-gray-800">{{ __('create booking') }}</h1> 
                </div> 
            <h4 class="d-flex align-items-center mb-3"></h4> 
            <br> 
 
           <!--Les rooooooooooooooooooooooooote w7da tngl3 --> 
            <form action="{{ route('admin.bookings.store') }}" method="POST"> 
 
 
 
 
                @csrf 
                <div class="row mb-3"> 
                    <div class="col-sm-3"> 
                        <h6 class="mb-0">Brand Name</h6> 
                    </div> 
                    <div class="col-sm-9 text-secondary"> 
                        <input name="brand_name" type="text" class="form-control" required autofocus/> 
                        <small style="color: #e20000" class="error" id="brand_name-error">Add Name</small> 
                    </div> 
                </div> 
 
 
 
                <div class="row mb-3"> 
                    <div class="col-sm-3"> 
                        <h6 class="mb-0">{{ __('Time To') }}</h6> 
                    </div> 
                    <div class="col-sm-9 text-secondary"> 
                        <div class="input-group date" id="datetimepicker_time_to" data-target-input="nearest"> 
                            <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker_time_to" id="time_to" name="time_to" value="{{ old('time_to', $timeTo) }}" required/> 
                            <div class="input-group-append" data-target="#datetimepicker_time_to" data-toggle="datetimepicker"> 
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div> 
                            </div> 
                        </div> 
                        <small style="color: #e20000" class="error" id="time_to-error"></small> 
                    </div> 
                </div> 
 
                <div class="row mb-3"> 
                    <div class="col-sm-3"> 
                        <h6 class="mb-0">{{ __('Short Description') }}</h6> 
                    </div> 
                    <div class="col-sm-9 text-secondary"> 
                        <textarea name="short_description" class="form-control" id="inputShortDescription" rows="3" required>{{ old('short_description') }}</textarea> 
                        <small style="color: #e20000" class="error" id="short_description-error"></small> 
                    </div> 
                </div> 
 
                <div class="row"> 
                    <div class="col-sm-3"></div> 
                    <div class="col-sm-9 text-secondary"> 
                        <input type="submit" class="btn btn-primary px-4" value="Save Changes" /> 
                    </div> 
                </div> 
            </form> 
        </div> 
    </div> 
    </div> 
@endsection 
 
@section('AjaxScript') 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> 
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"

Farah Info, [01/05/2024 21:21]
integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> 
 
        <!-- Scripts pour le sélecteur de date et d'heure --> 
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> 
    <script> 
        $('.datetimepicker').datetimepicker({ 
            format: 'YYYY-MM-DD HH:mm', 
            locale: 'en', 
            sideBySide: true, 
            icons: { 
                up: 'fas fa-chevron-up', 
                down: 'fas fa-chevron-down', 
                previous: 'fas fa-chevron-left', 
                next: 'fas fa-chevron-right' 
            }, 
            stepping: 10 
        }); 
    </script> 
 
 
<script type="text/javascript"> 
        $(document).ready(function(){ 
            $('#brand_form').on('submit', function(event){ 
                event.preventDefault(); 
                // remove errors if the conditions are true 
                $('#brand_form *').filter(':input.is-invalid').each(function(){ 
                    this.classList.remove('is-invalid'); 
                }); 
                $('#brand_form *').filter('.error').each(function(){ 
                    this.innerHTML = ''; 
                }); 
                $.ajax({ 
                    url: "{{route('brand-create')}}", 
                    method: 'POST', 
                    data: new FormData(this), 
                    dataType: 'JSON', 
                    contentType: false, 
                    cache: false, 
                    processData: false, 
                    success : function(response) 
                    { 
                        // remove errors if the conditions are true 
                        $('#brand_form *').filter(':input.is-invalid').each(function(){ 
                            this.classList.remove('is-invalid'); 
                        }); 
                        $('#brand_form *').filter('.error').each(function(){ 
                            this.innerHTML = ''; 
                        }); 
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
                    error: function(response) { 
                        var res = $.parseJSON(response.responseText); 
                        $.each(res.errors, function (key, err){ 
                            $('#' + key + '-error').text(err[0]); 
                            $('#' + key ).addClass('is-invalid'); 
                        }); 
                    } 
                }); 
            }); 
        }); 
    </script> 
@endsection