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
                <h1 class="h4 text-gray-900 mb-5">¡Datos del Prestamo!</h1>
              </div>
              <form id="prestamoForm" class="user">
<!-- Tipo de usuario -->
                <div class="form-group ">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0"> 
                      <div class="md-form">
                          <label class="text-bolder active"> Tipo de usuario </label>
                          <input type="text" class="text-capitalize form-control" value="{{$element->tipo}}" disabled> 
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
                       <input type="text" class="text-capitalize form-control" value="{{$element->usuario}}" disabled> 
                       <label class="text-bolder active"> Usuario </label>
                    </div>
                   
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
                        
                     </div> 
                  </div>
                  <div class="row">
                    <p id="userError" class="ml-3"></p>
                  </div>
                </div>
<!-- Libro -->
                <div class="form-group m-0 p-0">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0">
                       <div class="md-form">
                      <input type="text" class="text-capitalize form-control" value="{{$element->libro}}" disabled> 
                       <label class="text-bolder active"> No. de adquisición</label>
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
                      <input type="text" class="text-capitalize form-control" value="{{$element->entrega}}" disabled> 
                       <label class="text-bolder active">Fecha de entrega</label>
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
                       {{ __('Entregar') }}
                    </div>
                   </div>
              </form>
            </div>
          </div>
        </div>
  </div>

 <!-- Modal Add Model -->
  <div class="modal fade" id="confirmarPrestamo" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="entregarLibro" method="POST" action="{{ route('prestamos.update', $element->id) }}">
    @csrf             
    <input type="hidden" name="_method" value="PUT">

      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">Solicitud de entrega</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          El libro con número de adquisición <b>{{$element->libro}}</b> sera devuelto a biblioteca.
           
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <button class="btn bg-primary text-white btn-sm" type="submit">
            {{ __('Confirmar') }}
          </button>
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

  function validar(){
        $('#confirmarPrestamo').modal('show');
  }

</script>


@endsection