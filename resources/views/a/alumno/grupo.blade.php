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

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row p-4">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center pb-5">
                    <h1 class="h4 text-gray-900 mb-4">
                      <div class="sidebar-brand-icon d-inline">
                        <i class="text-primary"><img src="{{url('/public/images/icon-md.png')}}" style="width: 50px;height: 50px;"></i>
                      </div>
                      <div class="sidebar-brand-text mx-2 text-primary h3 text-bold m-0 d-inline">SIGEDI</div>
                    </h1>

                  </div>

                   <form method="POST" action="{{ route('alumno.update',999999) }}" aria-label="{{ __('Login') }}" class="user">
                        @csrf
                    <input type="hidden" name="_method" value="PUT">    
                    <div class="row m-0 p-0">
                      <h5 class="mb-4">Que tal <i class="text-primary text-capitalize">{{ Auth::user()->name }}</i> al parecer no estas registrado en ningun grupo.</h5>
                    </div>
                    <div class="row m-0 p-0">
                      <div class="col-md-12 col-xs-12 p-0">
                        <div class="md-form">
                          <label class="text-danger text-bolder"> * </label>
                          <select class="text-uppercase ml-2 form-control{{ $errors->has('grupo') ? ' is-invalid' : '' }}
                          {{ (old('grupo') == '') ? ' empty' : '' }}" name="grupo" id="grupo">
                            <option value=""> Elige un grupo</option>
                            @foreach($grupos as $grupo)
                              <option value="{{$grupo->id}}">{{$grupo->grupo}}</option>
                            @endforeach
                           
                          </select>
                          @if ($errors->has('grupo'))
                            <span class="invalid-feedback d-block mb-1" role="alert">
                                <strong>{{ $errors->first('grupo') }}</strong>
                            </span>
                            @endif
                      </div>
                      </div>
                    </div>


                    <div class="form-group text-right mt-4">
                    <button type="submit" class="btn text-light" style="background: #551D30 !important;">
                       {{ __('Continuar') }}
                    </button>
                    </div>
                  </form>


                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>





  <!-- Bootstrap core JavaScript-->
  <script src="{{url('/public/dashboard')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{url('/public/dashboard')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('/public/dashboard')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('/public/dashboard')}}/js/sb-admin-2.min.js"></script>

</body>

</html>
