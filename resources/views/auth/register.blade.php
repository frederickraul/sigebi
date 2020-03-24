<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Registro</title>
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
    background-image: url('resources/img/undraw/gold-undraw_sign_in_e6hj.svg') !important; 
  }
</style>
</head>


<body style="background: #551D30;">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">

                <div class="card-body">
                    <!-- Nested Row within Card Body -->
            <div class="row p-2 p-sm-4">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                  <div class="text-center pb-5">
                    <h1 class="h4 text-gray-900 mb-4">
                      <div class="sidebar-brand-icon d-inline">
                        <i class="text-primary"><img src="{{url('/public/images/icon-md.png')}}" style="width: 50px;height: 50px;"></i>
                      </div>
                      <div class="sidebar-brand-text mx-2 text-primary h3 text-bold m-0 d-inline">SIGEDI</div>
                    </h1>
                  </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="type" value="docente">
                        
                        <div class="row m-0 p-0 px-1 px-sm-5">
                          <div class="col-md-12 col-xs-12 p-0">
                            <div class="form-group md-form">
                        
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                <label for="name" class="active">{{ __('Name') }}</label>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row m-0 p-0 px-1 px-sm-5">
                          <div class="col-md-12 col-xs-12 p-0">
                            <div class="form-group md-form">
                            
                                <input id="numero" type="text" class="form-control @error('numero') is-invalid @enderror" name="numero" value="{{ old('numero') }}" required autocomplete="numero">
                                <label for="numero" class="active"> Matrícula</label>

                                @error('numero')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row m-0 p-0 px-1 px-sm-5">
                          <div class="col-md-12 col-xs-12 p-0">
                            <div class="form-group md-form">
                            
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <label for="password" class="active">{{ __('Password') }}</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                        </div>

                        <div class="row m-0 p-0 px-1 px-sm-5">
                          <div class="col-md-12 col-xs-12 p-0">
                            <div class="form-group md-form">
                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <label for="password-confirm" class="active">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>
                        </div>

                 <div class="form-group text-right pr-2">
                    <button type="submit" class="btn text-light" style="background: #551D30 !important;">
                       {{ __('Registrar') }}
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
