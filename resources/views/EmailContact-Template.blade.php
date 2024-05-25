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
                   
                   <p><b>Nom :</b>{!! $name !!}  </p>
                   <p><b>Email :</b> {!! $email !!}  </p>
                   <p><b>Message  :</b> {!! $content !!}</p>
                   
               </div>
           </div>
       </div>
   </div>
</div>
