<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Salam Alaykom!</div>
                  <div class="card-body">
                   @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                           {{ __('A fresh mail has been sent to your email address.') }}
                       </div>
                   @endif
                   
                   <p>Email: {!! $email !!}  </p>
                   <p>Adresse: {!! $adresse !!}  </p>
                   <p> Catégorie de produit: {!! $typep !!}</p>
                   <p>Type de panne : {!! $typepanne !!}</p>
                   <p  >Description du problème : {!! $content !!}</p>
               </div>
           </div>
       </div>
   </div>
</div>
