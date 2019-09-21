@extends('layouts.admin')

@section('content')
<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">
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

#BooksTable_filter{
    display: none !important; 
}
  @media (max-width: 576px) { 
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
}
  
</style>
<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-12">
                  <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Sistema de Gestión de Biblioteca</a></h1>

        </div>
      
    </div>
          <!-- Color System -->
          <div class="row bg-white m-md-4 p-md-3">

            <div class="col-lg-12 mb-4">

              <!-- Illustrations -->
              <div class="">

                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 40rem;" src="{{url('resources')}}/img/undraw/undraw_Bibliophile_hwqc.svg" alt="">
                  </div>
                  <p></p>
                  
                </div>
              </div>

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
 <script type="text/javascript">
        $.extend( $.fn.dataTable.defaults, {
            language: {
                "processing": "Buscando. Por favor espere..."
            },
         
        });
    </script>
    <script type="text/javascript">
        var action = '<button data-toggle="tooltip" title="Actualizar" class="pd-setting-ed text-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+'<button data-toggle="tooltip" title="Eliminar" class="pd-setting-ed text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
    var table = $('#BooksTable').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: '{!! url("books-data") !!}',
        columns: [
            { data: 'numero', name: 'numero'},
            { data: 'clasificacion', name: 'clasificacion', class : "text-uppercase"},
            { data: 'titulo', name: 'titulo', class : "text-uppercase"},
            { data: 'estado', name: 'estado' },
            { data: 'autor', name: 'autor' },
            { data: 'volumen', name: 'volumen' },
            { data: 'ejemplar', name: 'ejemplar' },
            { data: 'estado', name: 'estado' },
        ]
    });

 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>
  @endsection