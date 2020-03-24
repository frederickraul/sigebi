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
                  <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}"> Mensajes
                  </a></h1>

        </div>
      
    </div>
          <!-- Color System -->
          <div class="row bg-white m-md-4 p-md-3">
            @foreach($mensajes as $mensaje)
            <div class="col-lg-12 mb-4">
                <div role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false" class="alert m-0 p-0">
                  <div class="toast-header">
                    <svg class=" rounded mr-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                      preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                      <rect fill="#007aff" width="100%" height="100%" /></svg>
                    <strong class="mr-auto">{{$mensaje->email}}</strong>
                    <small>{{$mensaje->created_at->diffForHumans()}}</small>
                    <a href="#" class="ml-2 mb-1 close" data-dismiss="alert" aria-label="close">&times;</a>
                  </div>
                  <div class="toast-body">
                    <strong class="text-bolder">{{$mensaje->nombre}}: </strong> {{$mensaje->mensaje}}
                    
                  </div>
                </div>
            </div>
            @endforeach
          </div>
  </div>



  @endsection