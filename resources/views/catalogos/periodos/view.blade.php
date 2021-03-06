@extends('layouts.admin')

@section('content')
<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">

     .dataTables_filter{
    display: none !important;
   }

  .dataTables_wrapper .dataTables_processing {
            position: absolute;
            top: 30%;
            left: 50%;
            width: 30%;
            height: 40px;
            margin-left: -20%;
            margin-top: -25px;
            padding: 20px;
            padding-bottom: 40px;
            text-align: center;
            font-size: 1.2em;
            /*background: #006DF0 !important;*/
            background: rgba(0,0,0,0.8);
            color: white;
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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Periodos
            <i class="far fa-calendar-alt prefix"></i></h1>
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
           <i class="far fa-calendar-alt prefix"></i>
            <input id="SearchBook" type="text" id="materialFormCardNameEx" class="form-control" placeholder="Buscar periodo">
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

    <div class="row bg-white m-md-4 px-2 px-md-5 pt-4">
      <div class="col-md-12 col-xs-12">
				<a class="btn bg-primary text-white float-right btn-sm" href="{{url('catalogos/periodos/create')}}">Registrar periodo</a>
      </div>
 
      <div class="col-md-12 col-xs-12">
         <table id="TablaAlumnos" class="table table-hover">
          <thead class="bg-primary text-white">
            <tr>
              <th>No.
              </th>
              <th>
                Año
              </th>
              <th>
                Semestre
              </th>
              <th>
                Acción
              </th>

            </tr>
          </thead>
          <tbody>

        </tbody>
        </table> 
      </div>
  </div>
</div>
<!-- /.container-fluid -->
<!-- Modal Windows -->
  <!-- Modal Delete Car -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="deleteForm" method="POST" action="">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">¿Necesitas eliminar el registro del alumno?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
            <h6 class="h6" id="matricula">Matrícula: </h6>
            <h6 class="h6" id="nombre">Nombre: </h6>
            <br>
            <h6 class="h6">¿Estas seguro?</h6>
            <input type="hidden" name="id" id="id">
            <input name="_method" type="hidden" value="delete">

          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
           <button class="btn bg-danger btn-sm text-white"> Confirmar </button>
          </div>
        </div>
          </form>
      </div>
    </div>
<!-- Modal Windows -->


<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="{{url('public')}}/js/addons/datatables-es.js"></script>
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
        ordering: true,
        ajax: '{!! url("periodos-data") !!}',
        columns: [
            { data: 'id', name: 'id',class: "id-number"},
            { data: 'year', name: 'year'},
            { data: 'semestre', name: 'semestre'},
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