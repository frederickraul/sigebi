@extends('layouts.admin')

@section('content')
<style type="text/css">
    .bg-login-image{
    background-image: url('{{url('resources/')}}/img/undraw/undraw_wall_post_83ul.svg') !important;
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
          <a href="{{url('/prestamos')}}"> / Prestamos </a> / Registrar
          <i class="fas fa-book-reader"></i><sup><i class="fas fa-plus"></i></sup></h1>
        </div>
    </div>
        <!-- Nested Row within Card Body -->
		    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

          <div class="col-lg-6">
            <div class="p-lg-5 p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-5">¡Registrar Prestamo!</h1>
              </div>
              <form id="prestamoForm" class="user" method="POST" action="{{ route('prestamos.store') }}">
              	  @csrf               
<!-- Tipo de usuario -->
                <div class="form-group ">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0"> 
                      <div class="md-form">
                          <label class="text-danger text-bolder"> * </label>
                          <select class="text-capitalize text-bolder ml-2 form-control" name="tipo" id="tipo">
                            <option value=""> Tipo de usuario</option>
                            <option value="alumnos"> Alumno</option>
                            <option value="profesores"> Profesor</option>
                          </select>
                      </div>
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
                      </div> 
                  </div>
                  <div class="row">
                    <p id="tipoError" class="ml-3 m-0 p-0"></p>
                  </div>
                  
                </div> 

<!-- Usuario -->
                <div class="form-group m-0 p-0">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0">
                       <div class="md-form">
                      <input type="number" class="text-capitalize form-control" id="usuario" name="usuario"> 
                      <label for="usuario" class="text-bolder{{ old('usuario') != '' ? ' active' : '' }}"><i class="text-danger"> * </i> Número o matrícula</label>
                    </div>
                   
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
                        
                     </div> 
                  </div>
                  <div class="row">
                    <p id="userError" class="ml-3"></p>
                  </div>
                </div>
<!-- Usuario -->
                <div id="grupoField" class="form-group m-0 p-0 d-none">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0">
                       <div class="md-form">
                      <input type="text" class="text-uppercase form-control" id="grupo" name="grupo"> 
                      <label for="grupo" class="text-bolder{{ old('grupo') != '' ? ' active' : '' }}"><i class="text-danger"> * </i> Grupo</label>
                    </div>
                   
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
                        
                     </div> 
                  </div>
                  <div class="row">
                    <p id="grupoError" class="ml-3"></p>
                  </div>
                </div>
<!-- Libro -->
                <div class="form-group m-0 p-0">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0">
                       <div class="md-form">
                      <input type="number" class="text-capitalize form-control{{ $errors->has('Libro') ? ' is-invalid' : '' }}" value="{{ old('libro') }}" id="libro" name="libro"> 
                      <label for="libro" class="text-bolder{{ old('libro') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>No. de adquisición</label>
                    </div>
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
                         
                     </div> 
                  </div>
                  <div class="row">
                    <p id="bookError" class="ml-3"></p>
                  </div>
                </div>
<!-- Fecha de entrega -->
                <div class="form-group m-0 p-0 mt-3">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0">
                       <div class="md-form">
                      <input type="date" class="text-capitalize form-control{{ $errors->has('fecha') ? ' is-invalid' : '' }}" value="{{ old('fecha') }}" id="fecha" name="fecha"> 
                      <label for="fecha"><i class="text-danger"> * </i>Fecha de entrega</label>
                    </div>
                
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
                        
                     </div> 
                  </div>
                  <div class="row">
                    <p id="dateError" class="ml-3"></p>
                  </div>
                </div>


               
                <hr>
                    <div class="form-group text-right pt-3">
                 <div class="btn text-white bg-primary btn-sm" onclick="validar()">
                       {{ __('Continuar') }}
                    </div>
                   </div>
              </form>
            </div>
          </div>
        </div>

  </div>

 <!-- Modal Add Model -->
  <div class="modal fade" id="confirmarPrestamo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form id="addAutorForm">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">Solicitud de prestamo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="userName" type="text" class="form-control text-uppercase" name="nombre" readonly="true">
                    <label for="nombre" class="active">{{ __('Usuario') }}</label>
                        <span class="invalid-feedback invalid-nombre" role="alert">
                          <strong id="invalid-nombre-message"></strong>
                        </span>
              </div>
            </div>
          </div>
          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="bookData" type="text" class="form-control text-uppercase">
                    <label for="bookData" class="active">{{ __('Libro') }}</label>
                        <span class="invalid-feedback invalid-apellido" role="alert">
                          <strong id="invalid-apellido-message"></strong>
                        </span>
                </div>
              </div>
            </div>

          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="bookReturn" type="text" class="form-control text-uppercase">
                    <label for="bookData" class="active">{{ __('Fecha de entrega') }}</label>
                        <span class="invalid-feedback invalid-apellido" role="alert">
                          <strong id="invalid-apellido-message"></strong>
                        </span>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn bg-primary text-white btn-sm" onclick="submitForm()">
            {{ __('Confirmar') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Autor -->

<script type="text/javascript">
  /*******************************
  *       Buscar Usuario
  *******************************/
  var localurl = "{!!url('/')!!}";

  $(document).ready(function(){
    $('#tipo').on("change", function(){
      tipo = $(this).val();
      if(tipo == "alumnos"){
        $('#grupoField').removeClass("d-none");
      }
      else{
        $('#grupoField').addClass("d-none");
         $('#grupo').val('');

      }
    });

  });

  function validar(){
     $('#tipoError').text('');
     $('#userError').text('');
     $('#bookError').text('');
     $('#grupoError').text('');

     tipo = $('#tipo').val();
     if(tipo == ""){
          $('#tipoError').html('<b class="text-danger"> Este campo es obligatorio</b>');
     }else if (tipo == "alumnos"){
          grupo = $('#grupo').val();
          if(grupo == ""){
              $('#grupoError').html('<b class="text-danger"> Este campo es obligatorio</b>');
          }else{
          searchUser();
       }

     }else{
      searchUser();
     }
    
  }
  function searchUser(){

            var user =$('#usuario').val();
                url = localurl+"/api/"+tipo+"/"+user;
                $.ajax({
                    type: 'GET',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (data){
                      $('#userName').val(data.nombre + " " + data.apellido);
                      searchBook();
                        
                    },
                    error: function(e) {
                      $('#userError').html('<b class="text-danger">No se encontro el usuario</b>');
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                    }});
                    
    }

  function searchBook(){

            var numero =$('#libro').val();
                url = localurl+"/api/libros/"+numero;
                $.ajax({
                    type: 'GET',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (data){
                      ValidateDate();
                      $('#bookData').val(data.clasificacion + ' ' + data.titulo);
                    },
                    error: function(e) {
                      $('#bookError').html('<b class="text-danger">No se encontro el libro</b>');
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                    }});
                    
    }

  function ValidateDate(){
      fecha = $('#fecha').val();
      if(fecha == ""){
        $('#dateError').html('<b class="text-danger">La fecha es invalida</b>');
      }else{      
        $('#bookReturn').val(fecha);
        $('#confirmarPrestamo').modal('show');
        day = new Date();
      }

  }

  function submitForm(){
    $('#prestamoForm').submit();
  }
</script>


@endsection