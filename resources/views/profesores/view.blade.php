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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Profesores
           <i class="fas fa-user-tie"></i><sup><i class="fas fa-check"></i></sup></h1>
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
            <i class="fas fa-user-tie prefix grey-text"></i>
            <input id="SearchBook" type="text" id="materialFormCardNameEx" class="form-control" placeholder="Buscar profesor">
          </div>
        </div>
    </div>
     @if(session()->has('delete'))
           <div class="alert alert-warning mx-md-4">
             <h4 class="h4">{{session('delete')}}</h4>
           </div>
    @endif

    <div class="row bg-white m-md-4 p-md-3 pt-3">
      <div class="col-md-12 col-xs-12">
				<a class="btn bg-primary text-light float-right btn-sm" href="{{url('profesores/create')}}">Registrar profesor</a>

         <table id="TablaProfesores" class="table table-striped table-primary-color mt-lg-0 mt-md-0 mt-sm-0 mt-5" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">No.
              </th>
              <th class="th-sm">
                Número
              </th>
              <th class="th-sm">Nombre
              </th>
              <th class="th-sm">Apellido
              </th>
              <th class="th-sm">
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
          <h5 class="modal-title" id="exampleModalLabel">¿Necesitas eliminar el registro del profesor?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
            <h6 class="h6" id="numero">Número: </h6>
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
<!-- Button -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<!-- Button -->
 <script type="text/javascript">
        $.fn.dataTable.ext.errMode = 'none';
        $.extend( $.fn.dataTable.defaults, {
            language: {
                "processing": "Buscando. Por favor espere..."
            },
         
        });
    </script>
    <script type="text/javascript">

    var table = $('#TablaProfesores').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: '{!! url("profesores-data") !!}',
        dom: 'Bfrtip',
        buttons: [
            { "extend": 'excel', "text":'<i class="fas fa-file-excel fa-2x"></i>',"className": 'btn btn-success btn-xs' },
            { "extend": 'pdf', "text":'<i class="fas fa-file-pdf fa-2x"></i>',"className": 'btn btn-danger btn-xs' }
        ],
        columns: [
            { data: 'id', name: 'id',class: "id-number"},
            { data: 'numero', name: 'numero'},
            { data: 'nombre', name: 'nombre', class : "text-capitalize"},
            { data: 'apellido', name: 'apellido', class : "text-capitalize"},
            { data: "id", class:"datatable-ct text-center th-sm", "render": function (data, type, row) {
              return '<a data-toggle="tooltip" title="Editar" class="pd-setting-ed text-warning ml-2" onclick="editElement('+data+')"><i class="fas fa-edit"></i></a> <a data-toggle="tooltip" title="Eliminar" class="pd-setting-ed text-danger ml-2" onclick="deleteElement('+data+')"><i class="fas fa-trash" ></i></a>'; }, "targets": 5 },
        ]
    });

function editElement(id){
  location.href ='profesores/'+id+'/edit';
}

function deleteElement(id){
  var id = id;
  url = '{!!url("/api/profesores")!!}'+"/"+id;
  $.ajax({
    url: url,
    type: 'GET',
    success: function(data){
      $("#id").val(data.id);
      $("#nombre").html("<b>Nombre: </b>"+data.nombre+","+data.apellido);
      $("#numero").html("<b>Número: </b>"+data.numero);
    }
  });

  $("#deleteForm").attr('action','profesores/'+id);
  $('#confirmDeleteModal').modal('show');
}
 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>
  @endsection