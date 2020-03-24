@extends('layouts.admin')

@section('content')
<style type="text/css">
    .bg-login-image{
    background-image: url('{{url('resources/')}}/img/undraw/undraw_new_entries_nh3h.svg') !important;
    background-position: center 10% !important;
    background-size: 80%;
    background-repeat: no-repeat;
  }
  .btn-primary{
    cursor: pointer;
  }




</style>
  <div class="container-fluid">
        <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-12">
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / 
            <a href="{{url('catalogos/asignaturas')}}">Grupos </a>
            <i class="fas fa-users prefix"></i></h1>
        </div>
    </div>
        <!-- Nested Row within Card Body -->
		    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

          <div class="col-lg-6">

        
            <div class="p-lg-5 p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-5">¡Registrar Grupo!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('grupos.store') }}" aria-label="{{ __('Register') }}">
              	  @csrf

<!-- Nombre -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-capitalize form-control" value="{{ old('semestre') }}" id="semestre" name="semestre"> 
                      <label for="semestre" class="text-bolder{{ old('semestre') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Semestre</label>
                    </div>
                    @if ($errors->has('semestre'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('semestre') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>

<!-- Nombre -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-capitalize form-control" value="{{ old('grupo') }}" id="grupo" name="grupo"> 
                      <label for="grupo" class="text-bolder{{ old('grupo') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Grupo</label>
                    </div>
                    @if ($errors->has('grupo'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('grupo') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>  

               
                <hr>
                    <div class="form-group text-right pt-3">
                 <button type="submit" class="btn text-white bg-primary btn-sm">
                       {{ __('Registrar') }}
                    </button>
                   </div>
              </form>
            </div>
          </div>
        </div>

  </div>



@endsection