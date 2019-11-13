@extends('layouts.admin')

@section('content')
<style type="text/css">
    .bg-login-image{
    background-image: url('{{url('resources/')}}/img/undraw/undraw_exams_g4ow.svg') !important;
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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a>
          <a href="{{url('/alumnos')}}"> / Alumnos </a> / Registrar
           <i class="fas fa-user-graduate"></i><sup><i class="fas fa-plus"></i></sup></h1>
        </div>
    </div>
        <!-- Nested Row within Card Body -->
		    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

          <div class="col-lg-6">

        
            <div class="p-lg-5 p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-5">¡Registrar Alumno!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('alumnos.store') }}" aria-label="{{ __('Register') }}">
              	  @csrf
<!-- Matricula -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="number" class="text-capitalize form-control{{ $errors->has('matricula') ? ' is-invalid' : '' }}" value="{{ old('matricula') }}" id="matricula" name="matricula"> 
                      <label for="matricula" class="text-bolder{{ old('matricula') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Matrícula</label>
                    </div>
                  
                      @if ($errors->has('matricula'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('matricula') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>
<!-- Titulo -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-capitalize form-control" value="{{ old('nombre') }}" id="nombre" name="nombre"> 
                      <label for="nombre" class="text-bolder{{ old('nombre') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Nombre</label>
                    </div>
                    @if ($errors->has('nombre'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('nombre') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>                
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-capitalize form-control" value="{{ old('nombre') }}" id="apellido" name="apellido"> 
                      <label for="apellido" class="text-bolder{{ old('apellido') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Apellido</label>
                    </div>
                    @if ($errors->has('apellido'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('apellido') }}</strong>                            
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