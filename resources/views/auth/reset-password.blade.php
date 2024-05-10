
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('backend.includes.favicon')
    @include('backend.includes.css')
    <title>Forgot password</title>
</head>
<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            
                            {{-- comment <img src="{{asset('backend_assets')}}/images/logo-img.png" width="180" alt="" />  --}}
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Changer Mot de passe</h3>
                                        
                                    </div>
                                    
                                    <div class="login-separater text-center mb-4"> <span>changer mot de passe</span>
                                        <hr/>
                                        <form method="POST" action="{{ route('password.store') }}">
                                            @csrf
                                    
                                            <!-- Password Reset Token -->
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                    
                                            <!-- Email Address -->
                                            <div>
                                                <label for="inputUserName" class="form-label">Email</label>
                                                <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                                                <x-input-error for="email" :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                    
                                            <!-- Password -->
                                            <div class="mt-4">
                                                <label for="inputUserName" class="form-label">Nouveau mot de passe</label>                                                <x-text-input id="password" class="block mt-1 w-full form-control" type="password" name="password" required autocomplete="new-password" />
                                                <x-input-error for="password" :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                    
                                            <!-- Confirm Password -->
                                            <div class="mt-4">
                                                <label for="inputUserName" class="form-label">Confirmer Mot de passe </label>                                    
                                                <x-text-input id="password_confirmation" class="block mt-1 w-full form-control"
                                                                    type="password"
                                                                    name="password_confirmation" required autocomplete="new-password" />
                                    
                                                <x-input-error for="password_confirmation" :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                    
                                            <div class="flex items-center justify-end mt-4">
                                                <x-primary-button>
                                                    {{ __('Réinitialiser') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    
                                    
                                    </div>
                                    <div class="form-body">
                                        <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    @include('backend.includes.js')
    
    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    </body>
    </html>




    