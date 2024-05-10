
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
                                        <h3 class="">Restaurer Mot de passe</h3>
                                        
                                    </div>
                                    <div class="d-grid">
                                        <a class="btn my-4 shadow-sm btn-white" href="social_auth/google"> <span class="d-flex
                                        justify-content-center align-items-center">
                              <img class="me-2" src="{{asset('backend_assets')}}/images/icons/search.svg" width="16"
                                   alt="Image
                              Description">
                              <span>Sign in with Google</span>
                                                </span>
                                        </a>
                                    </div>
                                    <div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH USERNAME</span>
                                        <hr/>
                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                    
                                            <!-- Email Address -->
                                            <div>
                                                <label for="inputUserName" class="form-label">Entez votre Email</label>                                                <x-text-input id="email" class="block mt-1 w-full form-control"   id="inputUserName" type="email" name="email" :value="old('email')" required autofocus />
                                                <x-input-error for="email" :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                    
                                            <div class="flex items-center justify-end mt-4">
                                                <x-primary-button>
                                                    {{ __('Envoyer') }}
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
    






    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    
