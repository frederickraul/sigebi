@extends('layouts.student')

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
        <div class="col-md-9">
          <h1 class="h3 mb-0 text-gray-800">
           <i class="fas fa-tasks"></i> <a href="{{url('a/clases').'/'.$actividad->tema['clase_id']}}">{{$actividad->tema['tema']}} </a></h1>
           <h6 class="mt-3 text-capitalize">Publicado {{$actividad->updated_at->diffForHumans()}}</h6>
           
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
        <div class="row px-4">
          <div class="col-lg-8 col-md-8">
            
                  <div id="accordion" class="mt-4">
                    <div class="card">
                      <div class="card-header bg-white" id="headingOne">
                        <small class="float-right"> Fecha de entrega: {{$actividad->fecha_de_entrega}}</small>
                        <h5 class="mb-0 text-left">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#actividad{{$actividad->id}}" aria-expanded="true" aria-controls="actividad{{$actividad->id}}">
                            <i class="fas fa-tasks mr-1"></i> {{$actividad->titulo}}
                          </button>
                        </h5>

                      </div>

                      <div id="actividad{{$actividad->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">

                        <div class="card-body text-left">
                          <div class="row">
                        <!-- Col -->
                            <div class="col-md-12 col-xs-12">
                              <p>
                                  {{$actividad->instrucciones}}
                              </p>
                                 

                                  <!-- ./upload-image-form -->      
                                  @if($actividad->archivo != "")
                                    <div class="col-md-4 col-sm-4 col-4">
                                          <a href="{{url('public').'/'.$actividad->url}}" target="_blank">
                                            <img class="img-fluid" src="{{url('resources\img\filestype').'/'.$actividad->tipo.'.png'}}">
                                          <!-- Image Description -->
                                          </a>
                                          <i> Ver archivo</i>
                                      </div>      
                                    @endif
                            </div>
                            <!-- ./Col -->

                          </div>
                        </div>

                      </div>
                    </div>           
                  </div> 
                </div>

                     <!-- Col -->
                            <div class="col-md-4 col-xs-4">
                              <div class="card mt-4">
                                <div class="card-header text-left bg-white">
                                  @if($trabajo->estado == 1)
                                    <small class="float-right text-info"> 
                                    Tarea entregada</small>
                                  @elseif($trabajo->estado == 2)
                                    <small class="float-right text-success"> Tarea completada</small>
                                  @else
                                  <small class="float-right text-danger"> Tarea pendiente</small>
                                  @endif
                                  <h6 class="mb-0 text-left text-primary"><i class="fas fa-share-square"></i> Entregar trabajo</h5>
                                  
                                </div>
                                <div class="card-body text-center bg-white">
                                  @if($trabajo->archivo != "")
                                      <a href="#" class="close" onclick="borrarElemento('{{route('trabajos.destroy', $trabajo->id)}}')">&times;</a>
                                      <img class="img-fluid" src="{{url('resources\img\filestype').'/'.$trabajo->tipo.'.png'}}">
                                      <i>{{$trabajo->archivo}}</i>
                                  @else
                                      <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only show">Loading...</span>
                                      </div>
                                        <form id="subirTrabajo" action="{{route('trabajos.store')}}" method="POST" class="dropzone">
                                          @csrf
                                          <input type="hidden" name="actividad_id" value="{{
                                          $actividad->id}}">
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
  </div>
</div>
<!-- /.container-fluid -->

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