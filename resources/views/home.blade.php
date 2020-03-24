@extends('layouts.admin')

@section('content')

<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">
/*
  #img-move{
    transition: .7s ease-in-out 0s;
  }

  #img-move:hover{
        transform: translate(300px,0px);

  }
  */

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
                  <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Sistema de Gestión de Didáctica
                  </a></h1>

        </div>
      
    </div>
          <!-- Color System -->
          <div class="row bg-white m-md-4 p-md-3">

            <div class="col-lg-12 mb-4">

              <!-- Illustrations -->
              <div class="">

                <div class="card-body">
                  <div class="text-center">
                    <img id="img-move" class="img-fluid px-3 px-sm-4mb-4" style="width: 40rem;" src="{{url('resources')}}/img/undraw/gold-undraw_professor_8lrt.svg" alt="">
                  </div>
                  <p></p>
                  
                </div>
              </div>

            </div>
          </div>

  </div>



  @endsection