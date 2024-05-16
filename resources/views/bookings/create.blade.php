@php use Illuminate\Support\Facades\Auth; @endphp
@php
$role = Auth::user()->role;
@endphp
@extends('backend.layouts.app')
@section('PageTitle', 'rendez vous')




 <!-- Load CSS first -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.3.7/jquery.datetimepicker.min.css"/>


 <!-- Load JS second -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <!-- Initialize JS, setup eventlistener(s) -->
 <script type="text/javascript">
  //jQuery(document).ready($ => $('.datetimepicker').datetimepicker());

  jQuery(document).ready($ => $('.datetimepicker').datetimepicker());

 </script>










@section('content')

    <!--breadcrumb -->

    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Rendez-vous</div>
        <div class="ps-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"><a href="{{ route($role . '-profile') }}"><i class="bx bx-home-alt"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Ajouter un rendez-vous</li>
            </ol>
          </nav>
        </div>
      </div>

      <div class="card">
      <div class="card-body">
        <h4 class="d-flex align-items-center mb-3">Ajouter un rendez-vous</h4>
         
        <form id="brand_form" action="{{ route('rendezvous.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="client_id" value="{{ $clientId }}">


            @csrf




            <div class="row mb-3">
              <div class="col-sm-3">
                <h6 class="mb-0">Date</h6>

              </div>
              <div class="col-sm-9 text-secondary">
                <input name="date_rendezvous" type="text" class="form-control datetimepicker" id="datepicker" required>

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
                <input type="submit" class="btn btn-primary px-4" value="Envoyer">
              </div>
            </div>
             @if($errors->any())
            <ul>
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          @endif
        </form>
      </div>
    </div>





@endsection



