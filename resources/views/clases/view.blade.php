@extends('layouts.admin')

@section('content')
<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">
.list-group{
  min-width: 200px;
}
  .card {
  background: #fff;
  border-radius: 2px;
  display: inline-block;
  margin: 1rem;
  position: relative;
  width: 250px;
  text-align: center;
}
  .card:hover{
    transition: .5s ease-in-out 0s;
    transform: scale(1.1);
    cursor: pointer;
  }


  @media (max-width: 576px) { 
  .dataTables_wrapper .dataTables_processing {
    width: 100%;
    font-size: 1.2em;
  }
  .dataTables_length{
    display: none !important;
  }

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

   .btn-sm{
    font-size: 10px !important;
   }

}
  
</style>
<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-9">
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Clases
           <i class="fas fa-user-graduate"></i></h1>
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
        <div class="row p-5">
           @if(count($periodos) < 1) 
          <h2 class="text-center mt-3">No hay ningun periodo dado de alta.</h2> @endif

          @foreach($periodos as $periodo)
            <ul class="list-group m-1"> 
                @if ($loop->first) 
                <li class="list-group-item active"> <h3 class="d-inline-block">{{$periodo->periodo}}</h3> 
                    <div class="dropdown text-right dropdown-primary d-inline-block float-right" style="cursor: pointer;">
                      <i class="fas fa-bars dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      </i>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" data-toggle="modal" data-target="#AsignarAsignaturaModal"href="#" > Asignatura</a>
                      </div>
                    </div>
                </li>
                @else
                <li class="list-group-item bg-secondary text-light">{{$periodo->periodo}}
                </li>
                @endif

               @foreach($periodo->clases->where('profesor_id', Auth::user()->id) as $clase)
                  <li class="list-group-item text-capitalize">
                    <a href="{{url('temas').'/'.$clase->id}}">
                      <i class="fas fa-chevron-down mr-2"></i>
                      {{$clase->asignatura['slug']}} 

                    </a>

                    <a href="#" class="ml-3 float-right"> <i class="fa fa-trash"></i></a>
                  </li>
               @endforeach
            </ul>
          @endforeach
            <ul class="list-group m-1">
              <li class="list-group-item bg-secondary text-light">2018-2
              </li>
              <li class="list-group-item">
              Geometría Analítica </li>
              <li class="list-group-item">Lógica</li>
            </ul>
            <ul class="list-group m-1">
              <li class="list-group-item bg-secondary text-light">2018-1
              </li>
              <li class="list-group-item">Programación Orientada a Objetos</li>
              <li class="list-group-item">Geometría Analítica</li>
              <li class="list-group-item">Lógica</li>
            </ul>

        </div>   
      </div>
  </div>
</div>
<!-- /.container-fluid -->

<!-- Modal Windows -->
    <!-- Modal Agregar tema -->
  <div class="modal fade" id="AsignarAsignaturaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form id="agregarTemaForm" method="POST" action="{{route('clases.store')}}">
      <div class="modal-content">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt"></i> Asignaturas</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf

          <div class="row m-0 p-0">
            <div class="col-md-12 p-0 mr-3">
              <div class="form-group md-form">
                <select class="form-control text-capitalize" name="asignatura">
                  @foreach($asignaturas as $asignatura)
                  <option value="{{$asignatura->id}}" class="text-capitalize"> {{$asignatura->slug}}</option>
                  @endforeach
                </select>
                <label for="unidad" class="active">{{ __('Asignatura') }}</label>
              </div>
              <div>
                <input type="hidden" name="periodo" value="{{ $periodo->id}}">
              </div>
            </div>

          </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <button class="btn bg-primary text-white btn-sm" type="submit"> Asignar</button>
           
        </div>
      </div>
    </form>
    </div>
  </div>


  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js">
  </script>

  <script type="text/javascript">
    $(document).ready(function(){
      toastr.options = {
          "closeButton": true, 
          "positionClass": "toast-top-left", // toast-top-right / toast-top-left / toast-bottom-right / toast-bottom-left
          "preventDuplicates": false, 
          "onclick": null,
          "showDuration": "300", // in milliseconds
          "hideDuration": "1000", // in milliseconds
          "timeOut": "5000", // in milliseconds
          "extendedTimeOut": "5000", // in milliseconds
          "hideMethod": "fadeOut"
      };
      toastr["info"]("Agrega contenido dando clic en una asignatura ");
    });

  
  </script>

  @endsection