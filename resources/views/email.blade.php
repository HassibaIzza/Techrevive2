@php use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
@endphp
@if(Auth::user())
    @if(Auth::user()->role)
    @php
    $data = DB::table('users')->where('id', Auth::id())->get()[0];
    $status = Auth::user()->status;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
	<title>contacter SAV ..</title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
	<!--===============================================================================================-->
	<link href='https://www.soengsouy.com/favicon.ico' rel='icon' type='image/x-icon'/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>

	<div class="bg-contact100"   >
		<div class="j">
			<div class="wrap-contact100"></br></br>
				<div class="contact100-pic js-tilt" data-tilt>

					<img src="images/abc3.png" alt="IMG">
				</div>

				<form action="{{ route('send.email') }}" class="contact100-form validate-form" method="post">
                    @csrf
					<span class="contact100-form-title">
						Contacter Service Aprés vente
                    </span>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

					<div class="wrap-input100 validate-input" data-validate = "Name is required">
						<input class="input100" type="text" name="name"  value="{{$data->name}}" required autofocus/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                        @error('name')
                            <span class="text-danger" style="color: red;"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email"   value="{{$data->email}}" required autofocus/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Adresse is required">
						<input class="input100" type="text" name="adresse"  value="{{$data->address}}" required autofocus/>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-home" aria-hidden="true"></i>
                        </span>
                        @error('adresse')
                        <span color="red" class="text-danger" style="color: red;"> {{ $message }} </span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Marque is required">
                        <select name="marque" id="marque" class="input100" style="width: 100%; padding: 18px; border: 1px solid #ccc; border-radius: 20px; box-sizing: border-box; margin-bottom: 20px;">
                            <option value="">Sélectionner une marque</option>
                            @if (!empty($marques))
                                @foreach ($marques as $marque)
                                    <option value="{{ $marque->id }}">{{ $marque->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">

                        </span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Catégoriee is required">
                        <select name="typep" id="state" class="input100" style="width: 100%; padding: 18px; border: 1px solid #ccc; border-radius: 20px; box-sizing: border-box; margin-bottom: 20px;">
                                <option value="">Sélectionner la catégorie de produit</option>
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">

                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Panne is required">
                        <select name="typepanne" id="city" class="input100"  style="width: 100%; padding: 18px; border: 1px solid #ccc; border-radius: 20px; box-sizing: border-box; margin-bottom: 20px;">
                                <option value="">Selectionner le type de panne</option>
                        </select>
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">

                        </span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate = "Message is required">
						<textarea class="input100" name="content" placeholder="Description du problème"></textarea>
                        <span class="focus-input100"></span>
                        @error('content')
                        <span color="red"class="text-danger" style="color: red;"> {{ $message }} </span>
                        @enderror
                    </div>

					<div class="c">
						<button type="submit" class="contact100-form-btn">
							Envoyer
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->

	<script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');


     $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
         }
    });
    $(document).ready(function() {
        $("#marque").change(function() {
            var marque_id = $(this).val();

            if (marque_id == "") {
                marque_id = 0;
            }



         $.ajax({
                url: '{{ url("/fetch-states/") }}/'+marque_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $('#state').find('option:not(:first)').remove();
                    $('#city').find('option:not(:first)').remove();

                    if (response['typep'].length > 0) {
                        $.each(response['typep'], function(key,value){
                            $("#state").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });

                    }
                }
            });
        });
        $("#state").change(function(){
            var typep_id = $(this).val();

            console.log(typep_id);

            if (typep_id == "") {
                var typep_id = 0;
            }
            $.ajax({
                url: '{{ url("/fetch-cities/") }}/'+typep_id,
                type: 'post',
                dataType: 'json',
                success: function(response) {
                    $('#city').find('option:not(:first)').remove();

                    if (response['typepanne'].length > 0) {
                        $.each(response['typepanne'], function(key,value){
                            $("#city").append("<option value='"+value['id']+"'>"+value['name']+"</option>")
                        });
                    }
                }
            });


        });
    });

</script>

@endif

@else
    @include('auth.login')
@endif

</body>
</html>
