<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login</title>
    <link rel="icon" href="{{url('/public/images/icon-xs.png')}}">

  <!-- Custom fonts for this template-->
  <link href="{{url('/public/dashboard')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- css bundled using Laravel-mix, a wrapper around Webpack -->
  <link rel="stylesheet" href="{{ url('public/css/sb-admin-2.css')}}">
  <link rel="stylesheet" href="{{ url('public/css/mdb.css')}}">
  <link rel="stylesheet" href="{{ url('public/css/style-dashboard.css')}}">

<style type="text/css">
  .bg-login-image{
    background-image: url('resources/img/undraw/undraw_access_account_99n5.svg') !important; 
  }
</style>
</head>


<body style="background: #551D30;">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row p-4">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-sm-5 p-2">
                  <div class="text-center pb-5">
                    <h1 class="h4 text-gray-900 mb-4">
                      <div class="sidebar-brand-icon d-inline">
                        <i class="text-primary"><img src="{{url('/public/images/icon-md.png')}}" style="width: 50px;height: 50px;"></i>
                      </div>
                      <div class="sidebar-brand-text mx-2 text-primary h3 text-bold m-0 d-inline">SIGEDI</div>
                    </h1>
                  </div>
                   <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="user">
                        @csrf
                    <div class="row m-0 p-0">
                      <div class="col-md-12 col-xs-12 p-0">
                        <div class="form-group md-form">
                          <input type="text" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" id="numero" aria-describedby="userHelp" placeholder=" 00000 " name="numero" value="{{ old('numero') }}" autofocus>
                          <label for="numero" class="active"> Usuario</label>
                          @if ($errors->has('numero'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('numero') }}</strong>
                                        </span>
                          @endif   
                        </div>
                      </div>
                    </div>

                    <div class="row m-0 p-0">
                      <div class="col-md-12 col-xs-12 p-0">
                        <div class="form-group md-form">
                          <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputPassword" placeholder=" **********" name="password">
                          <label for="password" class="active"> Contraseña</label>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
                      </div>

                    <div class="form-group text-right pr-2">
                      <a href="register">
                        <small>¿Aún no tienes cuenta? Regístrate</small>
                        </a>
                     </div> 
                      <div class="form-group text-right pr-2">
                    <button type="submit" class="btn text-light" style="background: #551D30 !important;">
                       {{ __('Ingresar') }}
                    </button>
                    </div>
                  </form>
                  <hr>


                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<!-- Mensaje -->
<div class="modal fade right" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-success modal-sm" role="document" style="position: absolute; right: 0; bottom: 0;">
      <!--Content-->
      <div class="modal-content">
          <form method="POST" action="{{ route('mensaje.store') }}">
        <!--Header-->
        <div class="modal-header bg-info">
          <p class="heading lead text-white"><i class="far fa-question-circle mr-1"></i> ¿Dudas?</p>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="white-text">×</span>
          </button>
        </div>

        <!--Body-->
        <div class="modal-body">
          <div class="text-center">
            <i class="far fa-question-circle fa-4x mb-3 animated rotateIn text-info"></i>
            <p>Si tienes problemas para ingresar o tienes alguna duda, envía un mensaje.</p>
          </div>


                
                        @csrf
                    <div class="row m-0 p-0">
                      <div class="col-md-12 col-xs-12 p-0">
                        <div class="form-group md-form">
                          <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" id="nombre" aria-describedby="userHelp" placeholder=" Raul Fonseca " name="nombre" value="{{ old('nombre') }}" autofocus>
                          <label for="nombre" class="active"> Nombre completo</label>
                          @if ($errors->has('nombre'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                          @endif   
                        </div>
                      </div>
                    </div>

                    <div class="row m-0 p-0">
                      <div class="col-md-12 col-xs-12 p-0">
                        <div class="form-group md-form">
                          <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" aria-describedby="userHelp" placeholder=" alguien@tallugar.com " name="email" value="{{ old('email') }}">
                          <label for="email" class="active"> Correo electrónico</label>
                          @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                          @endif   
                        </div>
                      </div>
                    </div>

                    <div class="row m-0 p-0">
                      <div class="col-md-12 col-xs-12 p-0">
                        <div class="form-group md-form">
                          <textarea class="form-control{{ $errors->has('mensaje') ? ' is-invalid' : '' }}" id="mensaje" aria-describedby="userHelp" name="mensaje">{{ old('nombre') }}</textarea>
                          <label for="mensaje" class="active"> Mensaje</label>
                          @if ($errors->has('mensaje'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mensaje') }}</strong>
                                        </span>
                          @endif   
                        </div>
                      </div>
                    </div>

                 
                      
        </div>

        <!--Footer-->
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-info waves-effect waves-light text-white">Enviar
            <i class="far fa-paper-plane ml-1 text-white"></i>
          </button>
        
        </div>
         </form>
      </div>
      <!--/.Content-->
    </div>
  </div>
<!-- Mensaje -->

<div id="successModal" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title text-white">Aviso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-white">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Tu mensaje ha sido enviado, verifica tu correo mas adelante.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-success text-white" data-dismiss="modal"
        onclick="$('#successModal').hide();">Cerrar</button>
      </div>
    </div>
  </div>
</div>




<!-- Bootstrap core JavaScript-->
  <script src="{{url('/public')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{url('/public')}}/js/popper.min.js"></script>
  <script src="{{url('/public')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('/public')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('/public')}}/js/sb-admin-2.min.js"></script>  

  <script src="{{url('/public')}}/js/mdb.js"></script>



<script type="text/javascript">
    @if(session()->has('success'))
           $(document).ready(function(){
            $("#successModal").modal('show');
          });
    @else 
      $(document).ready(function(){
        $("#mensajeModal").modal('show');
      });
    @endif 
  



</script>
</body>

</html>
