<!doctype html>
<html lang="fr">
@php
$errList = [];
$errList['name'] = $errors->get('name') ? $errors->get('name')[0] : null;;
$errList['email'] = $errors->get('email') ? $errors->get('email')[0] : null;;
$errList['username'] = $errors->get('username') ? $errors->get('username')[0] : null;;
$errList['passwordErr'] = $errors->get('password') ? $errors->get('password')[0] : null;
@endphp
<head>
    <!-- Balises méta requises -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.includes.favicon')
    @include('backend.includes.css')
    <title>Inscription</title>
</head>

<body class="bg-login">
<!--wrapper-->
<div class="wrapper">
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="my-4 text-center">
                        {{-- comment <img src="{{asset('backend_assets')}}/images/logo-img.png" width="180" alt="" />--}}
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Inscription</h3>
                                    <p>Vous avez déjà un compte ? <a href="{{ url('/login') }}">Connectez-vous ici</a></p>
                                </div>
                                <div class="d-grid">
                                    <a class="btn my-4 shadow-sm btn-white" href="social_auth/google"> 
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="{{asset('backend_assets')}}/images/icons/search.svg" width="16" alt="Description de l'image">
                                            <span>Inscription avec Google</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="login-separater text-center mb-4"> 
                                    <span>OU INSCRIVEZ-VOUS AVEC VOTRE EMAIL</span>
                                    <hr/>
                                </div>
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="{{route('register')}}">
                                        @csrf
                                        <input type="text" name="role" value="vendor" hidden/>
                                        <div class="col-sm-12">
                                            <label for="inputName" class="form-label">Nom</label>
                                            <input name="name" type="text" class="form-control" id="inputName" placeholder="Votre nom" autocomplete="name" value="{{old('name')}}" autofocus required>
                                            <small style="color: #e20000" class="error">{{$errList['name']}}</small>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Adresse Email</label>
                                            <input name="email" type="email" class="form-control" id="inputEmailAddress" autocomplete="username" required placeholder="exemple@utilisateur.com" value="{{old('email')}}">
                                            <small style="color: #e20000" class="error">{{$errList['email']}}</small>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputUserName" class="form-label">Nom d'utilisateur</label>
                                            <input name="username" type="text" class="form-control" id="inputUserName" placeholder="Choisissez un nom d'utilisateur unique" autocomplete="username" autofocus required value="{{old('username')}}">
                                            <small style="color: #e20000" class="error">{{$errList['username']}}</small>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Mot de passe</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input name="password" type="password" class="form-control border-end-0" autocomplete="new-password" required id="inputChoosePassword" placeholder="Entrez le mot de passe">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                            <small style="color: #e20000" class="error">{{$errList['passwordErr']}}</small>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Confirmer le mot de passe</label>
                                            <div class="input-group" id="show_hide_password_2">
                                                <input name="password_confirmation" type="password" class="form-control border-end-0" autocomplete="new-password" required id="password_confirmation" placeholder="Confirmez le mot de passe">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="inputRole" class="form-label">Rôle de l'utilisateur</label>
                                            <select name="role" class="form-select" id="inputRole" required>
                                                <option value="vendor">Vendeur</option>
                                                <option value="client">Client</option>
                                                <option value="reparateur">Réparateur</option>
                                                <option value="Fabricant">Fabricant</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Inscription</button>
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

        $("#show_hide_password_2 a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password_2 input').attr("type") == "text") {
                $('#show_hide_password_2 input').attr('type', 'password');
                $('#show_hide_password_2 i').addClass("bx-hide");
                $('#show_hide_password_2 i').removeClass("bx-show");
            } else if ($('#show_hide_password_2 input').attr("type") == "password") {
                $('#show_hide_password_2 input').attr('type', 'text');
                $('#show_hide_password_2 i').removeClass("bx-hide");
                $('#show_hide_password_2 i').addClass("bx-show");
            }
        });
    });
</script>
</body>

</html>
