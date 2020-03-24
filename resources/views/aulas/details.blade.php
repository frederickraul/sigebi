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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Aulas / {{$grupo->grupo}}
            <i class="fas fa-object-group"></i></h1>
    
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
           @if(count($grupo->alumnos) < 1) 
          <h2 class="text-center mt-3">No hay ninguna actividad registrada.</h2> @endif 
          <div class="col-lg-10 col-md-10 col-xs-12">
            
                  <div id="accordion" class="mt-4">
          @foreach($grupo->alumnos as $alumno)
                    <div class="card">
                      <div class="card-header bg-white" id="headingOne">
                        <i class="float-right"> Fecha de registro {{$alumno->created_at->diffForHumans()}}</i>
                        <h5 class="mb-0 text-left">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#alumno{{$alumno->id}}" aria-expanded="true" aria-controls="alumno{{$alumno->id}}">
                            <i class="fas fa-tasks mr-1"></i> {{$alumno->nombre}}
                          </button>
                        </h5>

                      </div>

                      <div id="alumno{{$alumno->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body text-left">
                          <div class="row">
                            <div class="col-sm-8 col-md-8 col-lg-10">
                                {{$alumno->id}}
                            </div>

                            <div class="col-sm-4 col-md-4 col-lg-2 text-center mt-4">
                                 
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