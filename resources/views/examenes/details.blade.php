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
            <h4>{{$grupo->grupo}}</h4>
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
        <div class="row p-2 p-sm-5 p-md-5">
            <table class="table table-hover">
              <thead class="bg-primary text-white">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Matrícula</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Resultado</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($alumnos as $alumnos)
                <tr class="text-gray-800 text-capitalize">
                  <th scope="row">{{$alumnos->id}}</th>
                  <td>{{$alumnos->matricula}}</td>
                  <td>{{$alumnos->user['name']}}</td>
                  <td>
                    @if($alumnos->user->examen)
                    {{$alumnos->user->examen->resultado['calificacion']}}
                    @endif</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
  </div>
</div>
<!-- /.container-fluid -->




<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="{{url('public')}}/js/addons/datatables-es.js"></script>

<script type="text/javascript">
  function cambiarClase(clase){
    $('#clase').val(clase);
    console.log(clase);
  }
</script>


<script type="text/javascript">
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>
  @endsection