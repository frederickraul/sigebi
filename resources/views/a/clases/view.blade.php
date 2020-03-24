@extends('layouts.student')

@section('content')
<!-- MDBootstrap Datatables  -->
<link href="{{url('public')}}/css/addons/datatables.min.css" rel="stylesheet">
<style type="text/css">

  .card-wrapper {
    position: relative;
    width: 100%;
    margin: 0;
    -webkit-perspective: 800px;
    perspective: 800px;
}

.card-wrapper .card-rotating {
    height: 100%;
    -webkit-transition: .5s;
    transition: .5s;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
}
.card {
    font-weight: 400;
    border: 0;
    -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
    transition: .5s ease-in-out 0s;
}
.card:hover {
    transform: scale(1.025);
    box-shadow: 0 4px 10px 0 rgba(0,0,0,0.32), 0 4px 20px 0 rgba(0,0,0,0.32);
}
.text-center {
    text-align: center !important;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,0.125);
    border-radius: .25rem;
}

.card-wrapper .card-up {
    height: 200px;
    overflow: hidden;
}

.white {
    background-color: #fff !important;
}
.ml-auto, .mx-auto {
    margin-left: auto !important;
}
.mr-auto, .mx-auto {
    margin-right: auto !important;
}

.card-wrapper .avatar {
    display: block;
    width: 120px;
    margin-top: -60px;
    overflow: hidden;
}

.card-wrapper .avatar img {
    width: 100%;
    background: none repeat scroll 0 0 #fff;
    border: 5px solid #fff;
}

.card-wrapper .card-up img {
    vertical-align: middle;
}
.img-fluid, .modal-dialog.cascading-modal.modal-avatar .modal-header, .video-fluid {
    max-width: 100%;
    height: auto;
}
.img-fluid {
    max-width: 100%;
    height: auto;
}

.card-body {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border-radius: 0 !important;
}

.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
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
              
            @if(count($aulas) < 1) 
              <h2 class="text-center mt-3">
              Aun no hay clases asignadas a este grupo.</h2> 
            @endif
          @foreach($aulas as $aula)
               <div class="col-lg-4 col-md-12 mb-4">
                <a href="clases/{{$aula->clase_id}}">
                <div class="card-wrapper" style="height: 408px;">
                      <div class="card card-rotating text-center">

                          <!--Front Side-->
                          <div class="face front">

                              <!-- Image-->
                              <div class="card-up">
                                  <img src="{{url('').'/'.$aula->clase->asignatura['imagen']}}" class="img-fluid" alt="Image with a photo of clouds.">
                              </div>
                              <!--Avatar-->
                              <div class="avatar mx-auto white">
                                @if($aula->clase->profesor->foto != "")
                                  <img src="{{url('').'/'.$aula->clase->profesor->foto}}" class="rounded-circle" alt="">
                                @else
                                  <img src="{{url('/resources')}}/img/undraw/gold-undraw_male_avatar_323b.svg" class="rounded-circle" alt="">
                                @endif
                                  
                              </div>
                              <!--Content-->
                              <div class="card-body">
                                  <h4>Raúl Suchilt Fonseca</h4>
                                  <p class="text-capitalize">{{$aula->clase->asignatura['slug']}}</p>
                                  <!--Triggering button-->
                                  
                              </div>
                          </div>
                          <!--/.Front Side-->
                      </div>
                    </div>
                  </a>
                  </div>
               @endforeach

  </div>
</div>
<!-- /.container-fluid -->

  @endsection