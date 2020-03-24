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
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Libros
           <i class="fas fa-book"></i><sup><i class="fas fa-check"></i></sup></h1>
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
            <i class="fa fa-book prefix grey-text"></i>
            <input id="SearchBook" type="text" id="materialFormCardNameEx" class="form-control" placeholder="Buscar libro">
          </div>
        </div>
    </div>
    <div class="row bg-white m-md-4 p-md-3 pt-3">
      <div class="col-md-12 col-xs-12">
				<a class="btn bg-primary text-light float-right btn-sm" href="{{url('libros/create')}}">Registrar libro</a>

         <table id="BooksTable" class="table table-striped table-primary-color mt-lg-0 mt-md-0 mt-sm-0 mt-5" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th class="th-sm">No.
              </th>
                <th class="th-sm">
                  <div>Clas.</div>
              </th>
              <th class="th-sm">Título
              </th>
              <th class="th-md">Categoría
              </th>
              <th class="th-md">Subcategoría
              </th>
              <th class="th-sm">Estado
              </th>
              <th class="th-md">Autor
              </th>
              <th class="th-md" data-visible="false">
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
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need to delete the car?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
            <h6 class="h6" id="stock">Stock</h6>
            <h6 class="h6">Are you sure?</h6>
            <input name="_method" type="hidden" value="delete">

          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <button class="btn btn-primary btn-sm"> Confirm </button>
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

    var table = $('#BooksTable').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: '{!! url("books-data") !!}',
        dom: 'Bfrtip',
        buttons: [
            { "extend": 'excel', "text":'<i class="fas fa-file-excel fa-2x"></i>',"className": 'btn btn-success btn-xs' },
            { "extend": 'pdf', "text":'<i class="fas fa-file-pdf fa-2x"></i>',"className": 'btn btn-danger btn-xs' }
        ],
        columns: [
            { data: 'numero', name: 'numero',class: "book-number"},
            { data: 'clasificacion', name: 'clasificacion', class : "text-uppercase"},
            { data: 'titulo', name: 'titulo', class : "text-capitalize"},
            { data: 'categoria.concepto', name: 'categoria.concepto'},
            { data: 'subcategoria.concepto', name: 'subcategoria.concepto'},
            { data: "estado.nombre", name: 'estado.nombre', "render": function (data, type, row) { 
              if(data == "Disponible"){ return '<div class="btn bg-primary btn-sm text-light">Disponible</div>'}
              if(data == "Prestado"){ return '<div class="btn bg-secondary btn-sm text-light">Prestado</div>'}
              if(data == "Perdido"){ return '<div class="btn bg-danger btn-sm text-light">Perdido</div>'}
              }, "targets": 3 },
            { data: 'autor', name: 'autor.nombre', class: 'text-capitalize', render: function ( data, type, row ) {
                  if(data !== null){
                  return data.nombre +' '+ data.apellido;
                }
              }},
              { data: 'autor.apellido', name: 'autor.apellido'},
            { data: "id", class:"datatable-ct", "render": function (data, type, row) { console.log(data);
              return '<a data-toggle="tooltip" title="Editar" class="pd-setting-ed text-warning ml-2"><i class="fas fa-edit"></i></a>'; }, "targets": 8 },

        ]
    });

    // Add event listener for opening and closing details
    $('#BooksTable tbody').on('click', 'tr', function () {
        var number = $(this).find('.book-number').text();
        console.log(number);
        location.href ='libros/'+number+'/edit';
 /*
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }*/
    } );
 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>
  @endsection