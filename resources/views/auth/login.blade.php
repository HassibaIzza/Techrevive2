<!doctype html>
<html lang="fr">
<head>
    <!-- Balises méta requises -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('backend.includes.favicon')
    @include('backend.includes.css')
    <title>Connexion</title>
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
                                    <h3 class="">Connexion</h3>
                                    <p>Vous n'avez pas encore de compte ? <a href="{{ url('/register') }}">Inscrivez-vous ici</a>
                                    </p>
                                </div>
                                <div class="d-grid">
                                    <a class="btn my-4 shadow-sm btn-white" href="social_auth/google"> <span class="d-flex justify-content-center align-items-center">
                          <img class="me-2" src="{{asset('backend_assets')}}/images/icons/search.svg" width="16" alt="Image Description">
                          <span>Connexion avec Google</span>
                      </span>
                                    </a>
                                </div>
                                <div class="login-separater text-center mb-4"> <span>OU CONNECTEZ-VOUS AVEC VOTRE NOM D'UTILISATEUR</span>
                                    <hr/>
                                </div>
                                <div class="form-body">
                                    <form id="login_form" class="row g-3" method="POST" action="{{route('login') }}">
                                        @csrf

                                        <div class="col-sm-12">
                                            <label for="inputUserName" class="form-label">Nom d'utilisateur</label>
                                            <input name="username" type="text" class="form-control" id="inputUserName" placeholder="Nom d'utilisateur" autocomplete="username" autofocus required>
                                            <small style="color: #e20000" class="error" id="username-error">{{isset($errors->get('username')[0]) ? $errors->get('username')[0] : null}}</small>
                                        </div>

                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Entrez le mot de passe</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input name="password" autocomplete="current-password" type="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Entrez le mot de passe" required>
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input name="remember" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Se souvenir de moi</label>
                                            </div>
                                            <a href="{{route('password.request')}}" class="forgot-password-link">Mot de passe oublié ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Connexion</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin de la rangée-->
        </div>
    </div>
</div>
<!--fin du wrapper-->
@include('backend.includes.js')

<!--Afficher et masquer le mot de passe js -->
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
