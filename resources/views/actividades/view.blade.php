@extends('layouts.admin')

@section('content')
<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">
.list-group{
  min-width: 200px;
}

  .card {
  border-radius: 10px;
  margin: 1rem;
  position: relative;
  width: 100% !important;
  text-align: center;
}
  .card:hover{
    transition: .5s ease-in-out 0s;
    cursor: pointer;
  }

  .dropzone{
    border: none !important;
  }


  @media (max-width: 576px) { 


  select, option{
    font-size: 10px !important;
    }


  input[type='text'] {
    font-size: 8px !important;
  }
  .col-xs-12{ 
    font-size: 10px !important;
   }

   td,th{
    padding: 5px !important;
   }

   tr{
        cursor: pointer important;

   }

}
  
</style>
<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-12">
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Actividades / <a href="#" class="text-capitalize"> {{$tema->clase->asignatura['slug']}} <i class="fas fa-tasks"></i> </a>
           </h1>
           <h4 class="mt-3 text-capitalize">{{$tema->tema}}</h4>
           
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
          
          </div>
        </div>
    </div>
    
    @if(session()->has('delete'))
           <div class="alert alert-warning alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('delete')}}</h4>
           </div>
    @endif   
    @if(session()->has('success'))
           <div class="alert alert-success alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('success')}}</h4>
           </div>
    @endif 
      @if(session()->has('danger'))
           <div class="alert alert-danger alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('danger')}}</h4>
           </div>
    @endif  
    @if(session()->has('warning'))
           <div class="alert alert-warning alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('warning')}}</h4>
           </div>
    @endif

    <div class="row bg-white m-md-4 p-md-3 pt-3">
      <div class="col-md-12 col-xs-12">
        <div class="row px-5 pt-4">
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#NuevaActividadModal"><i class="fas fa-plus mr-1"></i> Crear</a>        
        </div> 
        <div class="row px-5">
           @if(count($actividades) < 1) 
          <h2 class="text-center mt-3">No hay ninguna actividad registrada.</h2> @endif 
          <div class="col-lg-10 col-md-10 col-xs-12">
            
                  <div id="accordion" class="mt-4">
          @foreach($actividades as $actividad)
                    <div class="card">
                      <div class="card-header bg-white" id="headingOne">
                        <i class="float-right"> Publicado {{$actividad->updated_at->diffForHumans()}}</i>
                        <h5 class="mb-0 text-left">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#actividad{{$actividad->id}}" aria-expanded="true" aria-controls="actividad{{$actividad->id}}">
                            <i class="fas fa-tasks mr-1"></i> {{$actividad->titulo}}
                          </button>
                        </h5>

                      </div>

                      <div id="actividad{{$actividad->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body text-left">
                          <div class="row">
                              <div class="col-12 text-right">
                                  <h5> Trabajos entregados: <i class="text-primary">{{count($actividad->trabajos)}}</i></h5> 
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                {{$actividad->instrucciones}}
                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-2 text-center mt-4">
                                  @if($actividad->archivo != "")
                                      <a href="#" class="close pr-3 text-danger" onclick="borrarElemento('{{route('actividades.destroy', $actividad->id)}}')"
                                        style="position: absolute; right: 0;">&times;</a>
                                      <a href="{{url('/public').'/'.$actividad->url}}" target="_blank">
                                        <img class="img-fluid" src="{{url('resources\img\filestype').'/'.$actividad->tipo.'.png'}}">
                                        <i>{{$actividad->archivo}}</i>
                                      </a>
                                  @else
                                      <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only show">Loading...</span>
                                      </div>
                                        <form id="subirTrabajo" class="dropzone p-0" action="{{route('actividades.update', $actividad->id)}}" method="POST">
                                          @csrf
                                          <input type="hidden" name="action" value="updateArchivo">
                                          <input type="hidden" name="_method" value="PUT">
                                            <div class="fallback">
                                              <input name="file" type="file" multiple />
                                            </div>
                                          </form>
                                  @endif
                                </div>
                         </div>


                           


                        </div>    
                      </div>
                    </div>           
          @endforeach      
                  </div> 
                </div>

        </div>   
      </div>
  </div>
</div>
<!-- /.container-fluid -->


<!-- modal-Windows -->
<!-- Agregar Enlace -->
  <div class="modal fade" id="NuevaActividadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <form action="{{route('actividades.store')}}" method="POST">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-tasks"></i> Actividad </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body">
              @csrf
              <input type="hidden" name="tema_id" value="{{$tema->id}}">
              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                  <div class="form-group md-form">
                    <input id="titulo" type="text" class="form-control" name="titulo" value="{{old('titulo')}}">
                    <label for="titulo" class="text-bold active text-primary"> Título</label>
                    @if ($errors->has('titulo'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('titulo') }}</strong>                           
                        </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                    <div class="form-group md-form">
                        <textarea id="instrucciones" type="text" class="form-control" name="instrucciones" placeholder="(Opcional)">{{old('instrucciones')}}</textarea>
                        <label for="instrucciones" class="text-bold active text-primary"> Instrucciones</label>
                    @if ($errors->has('instrucciones'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('instrucciones') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>

              <div class="row m-0 p-0">
                <div class="col-md-4 col-xs-4 p-2">
                  <div class="form-group md-form">
                    <input id="puntos" type="number" class="form-control" name="puntos" value="{{old('puntos')}}">
                    <label for="puntos" class="text-bold active text-primary"> Puntos</label>
                    @if ($errors->has('puntos'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('puntos') }}</strong>                           
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-8 col-xs-8 p-2">
                  <div class="form-group md-form">
                    <input id="fecha_de_entrega" type="date" class="form-control" name="fecha_de_entrega" value="{{old('fecha_de_entrega')}}">
                    <label for="fecha_de_entrega" class="text-bold active text-primary" style="top: 20px !important;"> Fecha de entrega</label>
                    @if ($errors->has('fecha_de_entrega'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('fecha_de_entrega') }}</strong>                           
                        </span>
                    @endif
                  </div>
                </div>

              </div>




                  </div>

            <div class="modal-footer">
              <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
               <button type="submit" class="btn bg-primary btn-sm text-white"> Confirmar </button>
            </div>
        </form>
        </div>
      
      </div>
    </div>
<!-- /.modal-windows -->


<script type="text/javascript">
  
  @if ($errors->has('titulo'))
    $("#NuevaActividadModal").modal('show');
  @endif
</script>

<form id="borrarElemento" action="" method="POST">
    @method('delete')
    @csrf
</form>


<!-- DropZone -->
<script type="text/javascript" src="{{url('public')}}/dashboard/js/dropzone.js"></script>
<script>
    function borrarElemento(value){
      $('#borrarElemento').attr('action', value);
      $('#borrarElemento').submit();
    }


  Dropzone.autoDiscover = false;
      //DROPZONE VARIABLE
    var uploaded = -10;
    $(".spinner-border").hide();

$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone("#subirTrabajo");
  myDropzone.on("addedfile", function(file) {
    $(".spinner-border").show();
  });

  myDropzone.on("uploadprogress", function(file, progress, bytesSent) {
      $(".spinner-border").show();
  });

  myDropzone.on("error", function(file, progress, bytesSent) {
    $(".spinner-border").hide();
  });

    myDropzone.on("success", function(file, progress, bytesSent) {
    $(".spinner-border").hide();
      location.reload();
  });

})

</script>

  @endsection