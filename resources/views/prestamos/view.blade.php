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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Prestamos
           <i class="fas fa-book-reader"></i></h1>
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
            <i class="fas fa-book-reader prefix grey-text"></i>
            <input id="SearchBook" type="text" id="materialFormCardNameEx" class="form-control" placeholder="Buscar prestamo">
          </div>
        </div>
    </div>
    @if(session()->has('create'))
           <div class="alert alert-success mx-md-4">
             <h4 class="h4">{{session('create')}}</h4>
           </div>
    @endif
     @if(session()->has('delete'))
           <div class="alert alert-warning mx-md-4">
             <h4 class="h4">{{session('delete')}}</h4>
           </div>
    @endif

    <div class="row bg-white m-md-4 p-md-3 pt-3">
      <div class="col-md-12 col-xs-12">
				<a class="btn bg-primary text-light float-right btn-sm" href="{{url('prestamos/create')}}">Registrar prestamo</a>

         <table id="TablaPrestamos" class="table table-striped table-primary-color mt-lg-0 mt-md-0 mt-sm-0 mt-5" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">No.
              </th>
              <th class="th-sm">
                Tipo
              </th>
              <th class="th-sm">Usuario
              </th>
              <th class="th-sm">Libro
              </th>
              <th class="th-sm">Estado
              </th>
              <th class="th-sm">Fecha Prestamo
              </th>
               <th class="th-sm">Fecha Entrega
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

<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="{{url('public')}}/js/addons/datatables-es.js"></script>
<script type="text/javascript" src="{{url('public')}}/js/moment-with-locales.js"></script>
 <script type="text/javascript">
        $.fn.dataTable.ext.errMode = 'none';
        $.extend( $.fn.dataTable.defaults, {
            language: {
                "processing": "Buscando. Por favor espere..."
            },
         
        });
    </script>
    <script type="text/javascript">

    var table = $('#TablaPrestamos').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: '{!! url("prestamos-data") !!}',
        columns: [
            { data: 'id', name: 'id',class: "id-number"},
            { data: 'tipo', name: 'tipo'},
            { data: 'usuario', name: 'usuario'},
            { data: 'libro', name: 'libro', class : "text-capitalize"},
            { data: 'estado', name: 'estado', "render": function (data, type, row) {
              if(data == 1){ return '<div class="btn bg-primary btn-sm text-light">Entregado</div>'}
              if(data == 0){ return '<div class="btn bg-secondary btn-sm text-light">Pendiente</div>'}
              if(data == "Perdido"){ return '<div class="btn bg-danger btn-sm text-light">Perdido</div>'}}, "targets": 4 },
            { data: 'created_at', name: 'created_at', "render": function (data) {
              return  moment(data).locale('es').format('MMM Do YYYY'); }, "targets": 5 },
            { data: 'entrega', name: 'entrega', class : "text-capitalize", "render": function (data) {
              return  moment(data).locale('es').format('MMM Do YYYY'); }, "targets": 6 },
            { data: "id", class:"datatable-ct text-center th-sm", "render": function (data, type, row) {
              return '<a data-toggle="tooltip" title="Editar" class="pd-setting-ed text-warning ml-2" onclick="editElement('+data+')"><i class="fas fa-edit"></i></a>'; }, "targets": 7 },
        ]
    });

function editElement(id){
  location.href ='prestamos/'+id+'/edit';
}
 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
    console.log(this.value);
} );
</script>
  @endsection