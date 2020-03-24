@extends('layouts.admin')

@section('content')
<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">


  .card {
  background: #fff;
  border-radius: 2px;
  display: inline-block;
  margin: 1rem;
  position: relative;
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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Examenes 
            <i class="fas fa-dice-d20"></i></h1>
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
          </div>
        </div>
    </div>
    @if(session()->has('delete'))
           <div class="alert alert-warning mx-md-4">
             <h4 class="h4">{{session('delete')}}</h4>
           </div>
    @endif   
    @if(session()->has('success'))
           <div class="alert alert-success mx-md-4">
             <h4 class="h4">{{session('success')}}</h4>
           </div>
    @endif 
      @if(session()->has('danger'))
           <div class="alert alert-danger mx-md-4">
             <h4 class="h4">{{session('danger')}}</h4>
           </div>
    @endif  
    @if(session()->has('warning'))
           <div class="alert alert-warning mx-md-4">
             <h4 class="h4">{{session('warning')}}</h4>
           </div>
    @endif

    <div class="row bg-white m-md-4 p-md-3 pt-3">
      <div class="col-md-12 col-xs-12">
        <div class="row p-5">
           @if(count($clases) < 1) 
          <h2 class="text-center mt-3">Aún no hay clases registradas.</h2> @endif
          @foreach($clases as $clase)
            <ul class="list-group m-1">
              <li class="list-group-item bg-primary text-white text-capitalize">{{$clase->asignatura['slug']}}
                <div class="dropdown text-right dropdown-primary d-inline-block ml-3 float-right" style="cursor: pointer;">
                    <i class="fas fa-bars dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </i>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" data-toggle="modal" data-target="#AsignarGrupoModal"href="#" onclick="cambiarClase('{{$clase->id}}')">Asignar Examen</a>
                    </div>
                  </div>
              </li>
              <li class="list-group-item">
                  @foreach($clase->aulas as $aula)
                    <div class="text-center d-inline-block mx-3">
                      <a href="{{url('examenes/').'/'.$aula->grupo['id']}}" class="text-center"> 
                        <i class="fas fa-file-signature fa-4x d-block">
                        </i>
                        {{$aula->grupo['grupo']}}
                      </a>
                    </div>
                  @endforeach

              </li>
            </ul>


            @endforeach
        </div> 

      </div>
  </div>
</div>
<!-- /.container-fluid -->


<!-- Modal Windows -->
    <!-- Modal Agregar tema -->
  <div class="modal fade" id="AsignarGrupoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form id="agregarTemaForm" method="POST" action="{{route('aulas.store')}}">
      <div class="modal-content">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt"></i> Grupo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf

          <div class="row m-0 p-0">
            <div class="col-md-12 p-0 mr-3">
              <div class="form-group md-form">
                <select class="form-control text-capitalize" name="grupo">
                  @foreach($grupos as $grupo)
                  <option value="{{$grupo->id}}" class="text-capitalize"> {{$grupo->grupo}}</option>
                  @endforeach
                </select>
                <label for="grupo" class="active">{{ __('Grupo') }}</label>
                <input id="clase" type="hidden" name="clase" value="">
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


<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="{{url('public')}}/js/addons/datatables-es.js"></script>

<script type="text/javascript">
  function cambiarClase(clase){
    $('#clase').val(clase);
    console.log(clase);
  }
</script>
 <script type="text/javascript">
        $.fn.dataTable.ext.errMode = 'none';
        $.extend( $.fn.dataTable.defaults, {
            language: {
                "processing": "Buscando. Por favor espere..."
            },
         
        });
    </script>
    <script type="text/javascript">

    var table = $('#TablaAlumnos').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: '{!! url("alumnos-data") !!}',
        columns: [
            { data: 'id', name: 'id',class: "id-number"},
            { data: 'matricula', name: 'matricula'},
            { data: 'nombre', name: 'nombre', class : "text-capitalize"},
            { data: 'apellido', name: 'apellido', class : "text-capitalize"},
            { data: "id", class:"datatable-ct text-center th-sm", "render": function (data, type, row) {
              return '<a data-toggle="tooltip" title="Editar" class="pd-setting-ed text-warning ml-2" onclick="editElement('+data+')"><i class="fas fa-edit"></i></a> <a data-toggle="tooltip" title="Eliminar" class="pd-setting-ed text-danger ml-2" onclick="deleteElement('+data+')"><i class="fas fa-trash" ></i></a>'; }, "targets": 5 },
        ]
    });

function editElement(id){
  location.href ='alumnos/'+id+'/edit';
}

function deleteElement(id){
  var id = id;
  url = '{!!url("/api/alumnos")!!}'+"/"+id;
  $.ajax({
    url: url,
    type: 'GET',
    success: function(data){
      $("#id").val(data.id);
      $("#nombre").html("<b>Nombre: </b>"+data.nombre+","+data.apellido);
      $("#matricula").html("<b>Matrícula: </b>"+data.matricula);
    }
  });

  $("#deleteForm").attr('action','alumnos/'+id);
  $('#confirmDeleteModal').modal('show');
}
 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>
  @endsection