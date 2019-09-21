<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SIGEBI</title>
  <link rel="icon" href="{{url('/resources')}}/img/admin.png">
  <!-- Custom fonts for this template-->
  <link href="{{url('/resources')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- css bundled using Laravel-mix, a wrapper around Webpack -->
  <link rel="stylesheet" href="{{ url('public/css/sb-admin-2.css')}}">
  <link rel="stylesheet" href="{{ url('public/css/mdb.css')}}">
  <link rel="stylesheet" href="{{ url('public/css/style-dashboard.css')}}">




   <script type="text/javascript">
   var localurl="{!!url('/')!!}";
 </script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light sidebar-primary accordion" id="accordionSidebar">
      <div class="sticky-top">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-graduation-cap text-primary"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-primary h3 text-bold m-0">SIGEBI</div>
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
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Books" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-book"></i>
          <span>Libros</span>
        </a>
        <div id="Books" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('libros')}}">
              <i class="fas fa-book"></i><sup><i class="fas fa-plus"></i></sup> Registrar Libro</a>
              <a class="collapse-item" href="{{url('libros')}}">
              <i class="fas fa-book"></i><sup><i class="fas fa-plus"></i></sup> Consultar Libro</a>
          </div>
        </div>
      </li>

            <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Students" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-user-graduate"></i>
          <span>Alumnos</span>
        </a>
        <div id="Students" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('users/create')}}">
              <i class="fas fa-user-graduate"></i><sup><i class="fas fa-plus"></i></sup> Add users</a>
            <a class="collapse-item" href="{{url('users')}}">
              <i class="fas fa-user-graduate"></i><sup><i class="fas fa-check"></i></sup> Check users</a>
          </div>
        </div>
      </li>   
               <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Teachers" aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-user-tie"></i>
          <span>Profesores</span>
        </a>
        <div id="Teachers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('dashboard/users/create')}}">
              <i class="fas fa-user-tie"></i><sup><i class="fas fa-plus"></i></sup> Add users</a>
            <a class="collapse-item" href="{{url('dashboard/users')}}">
             <i class="fas fa-user-tie"></i><sup><i class="fas fa-check"></i></sup> Check users</a>
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
    <div id="content-wrapper" class="d-flex flex-column">

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
                  Alerts Center
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
                <a class="dropdown-item text-center small text-gray-500" href="{{url('/logs')}}">Show Activity Log</a>
              </div>
            </li>


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> </span>
                <img class="img-profile rounded-circle" src="{{url('/resources')}}/img/users/zak.jpg">
                 <label class="m-2 text-white"> Prof. Zak Fonseca <i class="fas fa-angle-down ml-2"></i></label>

              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url('dashboard/profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Perfil
                </a>
                <a class="dropdown-item" href="{{url('dashboard/settings')}}">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Configuración
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Salir
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Include js bundle from webpack -->
         <script src="{{url('resources')}}/vendor/jquery/jquery.min.js"></script>
         <script src="{{url('resources')}}/js/popper.min.js"></script>
         <script src="{{url('resources')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
         <script src="{{url('resources')}}/js/mdb.js"></script>
         <script src="{{url('resources')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
         <script src="{{url('resources')}}/js/sb-admin-2.min.js"></script>

  @yield('content')
        </div>
      <!-- End of Main Content -->

  
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Raúl Fonseca 2019</span>
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
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "salir" si estas listo para cerrar sesiòn.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="{{url('/logout')}}">Salir</a>
        </div>
      </div>
    </div>
  </div>




</body>

</html>

  