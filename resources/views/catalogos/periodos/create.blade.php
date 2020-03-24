@extends('layouts.admin')

@section('content')
<style type="text/css">
    .bg-login-image{
    background-image: url('{{url('resources/')}}/img/undraw/undraw_calendar_dutt.svg') !important;
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
            <a href="{{url('catalogos/periodos')}}">Periodos </a>
            <i class="far fa-calendar-alt prefix"></i></h1>
        </div>
    </div>
        <!-- Nested Row within Card Body -->
		    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

          <div class="col-lg-6">

        
            <div class="p-lg-5 p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-5">¡Registrar Periodo!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('periodos.store') }}" aria-label="{{ __('Register') }}">
              	  @csrf

<!-- Año -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="number" class="text-capitalize form-control" value="{{ old('año') }}" id="año" name="año"> 
                      <label for="año" class="active text-bolder text-primary"><i class="text-danger"> * </i>Año</label>
                    </div>

                    @if ($errors->has('año'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('año') }}</strong>                            
                        </span>
                    @elseif ($errors->has('periodo'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('periodo') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>

<!-- Año -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <select class="text-capitalize form-control" id="semestre" name="semestre"> 
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                      </select>
                      <label for="semestre" class="active text-primary text-bolder{{ old('semestre') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Semestre</label>
                    </div>
                    @if ($errors->has('semestre'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('semestre') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>

                <!--Periodo -->
                 <input type="hidden" class="form-control" value="{{ old('periodo') }}" id="periodo" name="periodo"> 
                <!--Periodo -->


               
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


<script type="text/javascript">
  var year;
  var semestre;
  var periodo;
  $(document).ready(function() {
    year = '{!! old('año') !!}';
    semestre = 1;
    periodo = year+"-"+semestre;
    console.log(periodo);
    $("#periodo").val(periodo);
  });

   $("#año").on('input',function(){
      year = $("#año").val();
      periodo = year+"-"+semestre;
       console.log(periodo);
       $("#periodo").val(periodo);
   });

    $("#semestre").change(function(){
      semestre = $("#semestre").val();
      periodo = year+"-"+semestre;
       console.log(periodo);
       $("#periodo").val(periodo);
   });
</script>

@endsection