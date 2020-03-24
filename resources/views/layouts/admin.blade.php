<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIGEDI</title>
  <link rel="icon" href="{{url('/public/images/icon-md.png')}}">
  <!-- Custom fonts for this template-->
  <link href="{{url('/public')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- css bundled using Laravel-mix, a wrapper around Webpack -->
  <link rel="stylesheet" href="{{ url('public/css/sb-admin-2.css')}}">
  <link rel="stylesheet" href="{{ url('public/css/mdb.css')}}">
  <link rel="stylesheet" href="{{ url('public/css/style-dashboard.css')}}">
  <!--Import materialize.css-->
  <style type="text/css">
     @media (max-width: 576px) { 
    .h3{
      font-size: 16px !important;
    }
  }
  </style>



   <script type="text/javascript">
   var localurl="{!!url('/')!!}";
 </script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-primary accordion toggled" id="accordionSidebar">
      <div class="sticky-top">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="text-primary"><img src="{{url('/public/images/icon-md.png')}}" style="width: 50px;height: 50px;"></i>
        </div>
        <div class="sidebar-brand-text mx-2 text-primary h3 text-bold m-0">SIGEDI</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Administrar
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('clases')}}" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-pencil-alt"></i>
          <span>Clases</span>
        </a>
      </li>       

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('aulas')}}" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-object-group"></i>
          <span>Aulas</span>
        </a>
      </li>  
      
      <li class="nav-item">
        <a class="nav-link" href="{{url('examenes')}}" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-dice-d20"></i>
          <span>Examenes</span>
        </a>
      </li>    

            <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('alumnos')}}" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-user-graduate"></i>
          <span>Alumnos</span>
        </a>


      </li>            

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#catalogos" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-th"></i>
          <span>Catalogos</span>
        </a>
        <div id="catalogos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('catalogos/periodos')}}">
              <i class="far fa-calendar-alt"></i> Periodos</a>

             <a class="collapse-item" href="{{url('catalogos/asignaturas')}}">
              <i class="fas fa-swatchbook"></i> Asignaturas</a>  

              <a class="collapse-item" href="{{url('catalogos/grupos')}}">
              <i class="fas fa-users"></i> Grupos</a>       
          </div>
        </div>
      </li>   
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline float-right pr-2 text-white">
        <button class="rounded-circle border-0 bg-primary text-white" id="sidebarToggle"></button>
      </div>
    </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column bg-gradient-light-2">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-primary topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-white"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->


            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if($logscount > 0)
                <span class="badge badge-danger badge-counter">{{$logscount}}+</span>
                @endif
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Mensajes
                </h6>
                @foreach($logs as $log)
                <a class="dropdown-item d-flex align-items-center" href="{{url('/logs/update/status')}}">
                  <div class="mr-3">
                    @if($log->action == 'add')
                    <div class="icon-circle bg-success">
                      <i class="fas fa-plus text-white"></i>
                     </div>
                    @elseif($log->action == 'update')
                    <div class="icon-circle bg-info">
                      <i class="fas fa-sync-alt text-white"></i>
                     </div>
                    @elseif($log->action == 'delete')
                    <div class="icon-circle bg-danger">
                      <i class="fas fa-trash text-white"></i>
                     </div>
                     @elseif($log->action == 'upload photo')
                    <div class="icon-circle bg-success">
                      <i class="fas fa-images text-white"></i>
                     </div> 
                     @elseif($log->action == 'delete photo')
                    <div class="icon-circle bg-danger">
                      <i class="fas fa-images text-white"></i>
                     </div>
                     @else
                      <div class="icon-circle bg-primary">
                      <i class="fas fa-info text-white"></i>
                       </div>
                      @endif
                  </div>
                  <div>
                    <div class="small text-gray-500">
                    {{  date('F d, Y', strtotime($log->created_at))}}</div>

                    @if($log->status == 1)
                    <span class="font-weight-bold">{{$log->user}} {{$log->action}} {{$log->make}} {{$log->model}} {{$log->year}} with stock number {{$log->stock}}!</span>
                    @else
                    <span class="">{{$log->user}} {{$log->action}} {{$log->make}} {{$log->model}} {{$log->year}} with stock number {{$log->stock}}!</span>
                    @endif
                  </div>
                </a>
                @endforeach
                <a class="dropdown-item text-center small text-gray-500" href="{{url('/mensaje')}}">Mostrar todos los mensajes</a>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown dropdown-primary">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> </span>
                @if(Auth::user()->foto != "")
                <img class="img-profile rounded-circle" src="{{url('/').'/'.Auth::user()->foto}}"> 
                @else
                <img class="img-profile rounded-circle" src="{{url('/resources')}}/img/undraw/gold-undraw_male_avatar_323b.svg">
                @endif
                 <label class="m-2 text-white"> {{ Auth::user()->name }} </label>

              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" style="max-width: 75px;">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" >
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

         <!-- Bootstrap core JavaScript-->
  <script src="{{url('/public')}}/vendor/jquery/jquery.min.js"></script>
  <script src="{{url('/public')}}/js/popper.min.js"></script>
  <script src="{{url('/public')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('/public')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('/public')}}/js/sb-admin-2.min.js"></script>  

  <script src="{{url('/public')}}/js/mdb.js"></script>

  <!-- Page level plugins -->
  <script src="{{url('/public')}}/vendor/chart.js/Chart.min.js"></script>


  @yield('content')
        </div>
      <!-- End of Main Content -->

  
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Raúl Fonseca <script>document.write(new Date().getFullYear());</script> </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "salir" si estas listo para cerrar sesiòn.</div>
        <div class="modal-footer">
          
                                   
          <div class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</div>
          <button type="submit" class="btn bg-primary btn-sm text-white">Salir</button>
        </div>
        </form>
      </div>
    </div>
  </div>




</body>

</html>

  