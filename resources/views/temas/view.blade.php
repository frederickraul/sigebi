@extends('layouts.admin')

@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/public/dashboard/')}}/css/dropzone.css">
<link rel="stylesheet" type="text/css" href="{{url('/public/')}}/css/modal-chat.css">
<style type="text/css">
  .tema{
    transition: .3s ease-in-out .0s;
  }
  .tema:hover{
    background: #f1f1f1
  }

  .dropzone{
    border: none !important;
  }





</style>

<!-- Begin Page Content -->
  <div class="container-fluid">
    <div class="jumbotron card card-image" style="background-image: url({{url('public/images/gradient5.jpg')}});">
      <div class="text-white text-center px-4">
        <div>
          <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong class="text-capitalize">
            {{$clase->asignatura['slug']}}</strong></h2>
          <p class="mx-5 mb-5">{{$clase->periodo['periodo']}}
          </p>

          <a class="btn btn-outline-white btn-md" data-toggle="modal" data-target="#modal-registrarAutor"><i class="fas fa-clone left"></i> Agregar Tema</a>

        </div>
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

  <div class="container-fluid" >
      <div id="parciales" class="row">
        <div class="col-12 col-sm-12 col-md-3 col-lg-2 card py-3 h-25 my-1">
         <ul class="m-0 p-0 text-center">
           <li class="nav-link d-inline-block p-0" onclick="filtrarParcial(1)"> 
              <a href="#parciales" class="btn p-1 px-sm-3"><i class="far fa-dot-circle text-primary"> Parcial 1</i></a> 
          </li>
           <li class="nav-link d-inline-block p-0" onclick="filtrarParcial(2)">
             <a href="#parciales" class="btn p-1 px-sm-3"><i class="far fa-dot-circle text-primary"> Parcial 2</i></a>
           </li>
           <li class="nav-link d-inline-block p-0" onclick="filtrarParcial(3)">
             <a href="#parciales" class="btn p-1 px-sm-3"><i class="far fa-dot-circle text-primary"> Parcial 3</i></a>
           </li>
         </ul>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9 card p-3 mx-md-4 my-1">
           @if(count($temas) < 1) 
          <h2 class="text-center mt-3">Aún no hay temas en esta clase.</h2> @endif
          <!--Section: Temas Box-->
         
          @foreach($temas as $tema)

            <section id="tema{{$tema->id}}" class="unidad{{$tema->parcial}} border-bottom tema">
              <div class="media mt-4 px-1">
                @if(Auth::user()->foto != "")
                <img class="card-img-100 rounded-circle d-flex z-depth-1 mr-3" src="{{url('/').'/'.Auth::user()->foto}}">
                @else
                <img class="card-img-100 rounded-circle d-flex z-depth-1 mr-3" src="{{url('/resources')}}/img/undraw/gold-undraw_male_avatar_323b.svg">
                @endif
                  
                <div class="media-body">
                 <!-- Basic dropdown -->
                 <i class="fas fa-ellipsis-v float-right mr-3 text-primary" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"></i>

                  <div class="dropdown-menu dropdown-primary">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#EditarTemaModal{{$tema->id}}">Editar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Eliminar</a>
                  </div>
                  <!-- Basic dropdown -->

                  <h6 class="font-weight-bold mt-0">
                    <a href="#tema{{$tema->id}}" class="text-default" href="#"><b>Tema: </b> {{$tema->tema}}</a>
                  </h6>
                  <i>Parcial {{$tema->parcial}} </i> -
                  <i>Unidad {{$tema->unidad}} </i>
                  <br>

                  <i class="fa fa-clock "> </i> {{$tema->updated_at->diffForHumans()}}
                  <br>
                  <a href="{{url('actividades').'/'.$tema->id}}" class="btn btn-secondary btn-sm mt-3"> Actividades</a>
                  
                  
                </div>
              </div>

              <div class="row p-md-3">
                @foreach($tema->elementosCompartidos as $elemento)

              <div class="col-md-6">
                <a href="{{url('public').'/'.$elemento->elemento}}" target="_blank">
                  <div class="row border border-primary rounded m-1" style="height: 75px !important;">
                    @if($elemento->tipo == "application/pdf")
                      <div style="background: url('{{url('public/images/pdf-background.jpg')}}');
                      background-size: cover !important; height: 73px !important; width: 125px !important; border-radius: 5px 0px 0px 5px;" class="col-4">
                      </div>
                    @else
                      <div style="background: url('{{url('public/images/file-background.jpg')}}');
                        background-size: cover !important; background-position: 50%; height: 73px !important; width: 125px !important; border-radius: 5px 0px 0px 5px;" class="col-4">
                      </div>
                    @endif
                    <!-- Image Description -->
                    <div class="col-8 py-2">
                      <p class="m-0 text-truncate"> {{$elemento->descripcion}}</p>
                      <b class="m-0"> 
                        @if($elemento->tipo == "application/pdf")
                          documento/pdf
                        @else
                            {{$elemento->tipo}}
                        @endif

                        </b>
                    </div>
                  </div>
                  </a>
                </div>            
                @endforeach


              <div class="col-12 mt-3"> 
                <h6 class="text-primary text-bold">
                  Enlaces compartidos
                </h6>
                  @if(count($tema->enlaces) < 1 )
                  <h6 class="mt-3">Aún no hay enlaces compártidos.</h6> 
                  @endif
                @foreach($tema->enlaces as $enlace)

                  <div class="px-sm-5 col-12">
                    <div class="row">
                      <div class="col-12 text-truncate">
                        <a href="{{$enlace->enlace}}" target="_blank">
                          <i class="fa fa-link">  {{ $enlace->descripcion}}.</i> </a>
                      </div>

                    </div>
                  </div>
                @endforeach
               
              </div>

              <div class="ml-auto d-block mt-3 mb-3">
                <ul class="list-unstyled list-inline mb-0">
                  <li class="list-inline-item " data-toggle="tooltip" data-placement="top" title="Subir Archivo">
                    <a href="#" class="text-default mr-3" data-toggle="modal" data-target="#SubirArchivoModal" onclick="cambiarTema('{{$tema->id}}')"><i class="fas fa-file-upload fa-2x"></i></a>
                  </li>

                  <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Compartir enlace">
                    <a href="" class="text-default mr-3" data-toggle="modal" data-target="#CompartirEnlaceModal" onclick="cambiarTema('{{$tema->id}}')"><i class="fas fa-link fa-2x"></i></a></li>

                  <li class="list-inline-item" data-toggle="tooltip" data-placement="top" title="Cuestionario">
                    <a href="{{url('cuestionarios').'/'.$tema->id}}" class="text-default mr-3"><i class="fas fa-file-alt fa-2x"></i></a></li>
                </ul>
                </div>


          </div>
        </section>
        @endforeach
      <!--Section: Temas Box-->
        </div>
      </div>
      
      <!-- Chat -->
        <div class="chat">
          <div id="dejarMensaje" class="btn btn-info" style="position: fixed; right: 80px; bottom: 20px;" data-toggle="modal" data-target="#chatModal">
            Dejar un mensaje
          </div>

          <!-- Mensaje -->
            <div class="modal fade right" id="chatModal">
                <div class="modal-dialog modal-success" role="document" style="position: absolute; right: 0; bottom: 0;">
                  <!--Content-->
                  <div class="modal-content">
                    <div class="modal-header text-white bg-info">
                      <div class="contact-profile">
                        @if(Auth::user()->foto != "")
                        <img src="{{url('/').'/'.Auth::user()->foto}}" alt="" />
                        @else
                        <img src="{{url('/resources')}}/img/undraw/gold-undraw_male_avatar_323b.svg" alt="" />
                        @endif

                        <p>{{Auth::user()->name}}</p>

                      </div>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                  <!-- Messenger -->

                    <div class="content">
                      
                      <div class="messages" style="height: 350px; overflow-y: scroll;">
                        <ul class="list">
                          @foreach($messages as $mensaje)
                            @if($mensaje->user_id == Auth::user()->id)  
                            <li class="sent">
                              <i class="small d-block ml-1">{{Auth::user()->name}}</i>
                              @if(Auth::user()->foto != "")
                              <img src="{{url('').'/'.Auth::user()->foto}}" alt="" />
                              @else
                              <img src="{{url('resources/img/undraw/gold-undraw_male_avatar_323b.svg')}}" alt="" />
                              @endif
                              
                              <p>{{$mensaje->mensaje}}</p>
                            </li>
                            @else
                              <li class="replies">
                                <i class="small d-block ml-1">{{$mensaje->user->name}}</i>
                              @if($mensaje->user->foto != "")
                              <img src="{{url('').'/'.$mensaje->user->foto}}" alt="" />
                              @else
                              <img src="{{url('resources/img/undraw/gold-undraw_male_avatar_323b.svg')}}" alt="" />
                              @endif
                              <p>{{$mensaje->mensaje}}</p>
                            </li>
                            @endif
                          @endforeach
                        </ul>
                      </div>
                      <div class="message-input">
                        <div class="wrap md-form">
                        <input id="mensaje" class="message_input" type="text" placeholder="Escribe tu mensaje..." />
                        <button class="send_message btn btn-info"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </div>
                      </div>

                      <div class="message_template" style="display: none;">
                        <li>
                          <i class="userName" class="small d-block ml-1"></i>
                            <img class="userPhoto" src=""/>
                            
                                <p class="text"></p>
                        </li>
                      </div>
                      

                  <!-- Messenger -->
                    </div>
                  </div>
                  <!--/.Content-->
                </div>
              </div>
            <!-- Mensaje -->
          
        </div>
        <!-- ./Chat -->

  </div>

<!-- Modal Windows -->
    <!-- Modal Agregar tema -->
  <div class="modal fade" id="modal-registrarAutor" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form id="agregarTemaForm" action="{{route('temas.store')}}" method="POST">
      <div class="modal-content">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt"></i> Tema</h5>

          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>


        </div>
        <div class="modal-body"> 
          @csrf
          <input type="hidden" name="clase" value="{{$clase->id}}">
          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="tema" type="text" class="form-control" name="tema">
                    <label for="tema"> Nombre del tema</label>
                </div>
          @if ($errors->has('tema'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('tema') }}</strong>                            
                        </span>
                    @endif

          
                 
              </div>
            </div>

          <div class="row m-0 p-0">
            <div class="col-md-3 col-xs-3 p-0 mr-3">
              <div class="form-group md-form">
                <select class="form-control" name="parcial">
                  <option value="1">Parcial 1</option>
                  <option value="2">Parcial 2</option>
                  <option value="3">Parcial 3</option>
                </select>
                <label for="unidad" class="active">{{ __('Parcial') }}</label>
              </div>
            </div>

          <div class="col-md-3 col-xs-3 p-0">
              <div class="form-group md-form">
                  <input id="unidad" type="number" class="form-control" name="unidad" value="1">
                    <label for="unidad" class="active">{{ __('Unidad') }}</label>
                        <span class="invalid-feedback" role="alert">
                          <strong id="invalid-nombre-message"></strong>
                        </span>
              </div>
            </div>
          </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <button type="submit" class="btn bg-primary text-white btn-sm">
           Agregar
          </button>
        </div>
      </div>
    </form>
    </div>
  </div>

@foreach($temas as $tema)
    <!-- Modal Editar tema -->
  <div class="modal fade" id="EditarTemaModal{{$tema->id}}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
    <form id="editarTemaForm">
      <div class="modal-content">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-comment-alt"></i> Tema</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf

          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="tema" type="text" class="form-control" name="tema" value="{{$tema->tema}}">
                    <label for="tema" class="active"> Nombre del tema</label>
                        <span class="invalid-feedback" role="alert">
                          <strong id="invalid-apellido-message"></strong>
                        </span>
                </div>
              </div>
            </div>

          <div class="row m-0 p-0">
            <div class="col-md-3 col-xs-3 p-0 mr-3">
              <div class="form-group md-form">
                <select class="form-control">
                  <option value="1">Parcial 1</option>
                  <option value="2">Parcial 2</option>
                  <option value="3">Parcial 3</option>
                </select>
                <label for="unidad" class="active">{{ __('Parcial') }}</label>
              </div>
            </div>

          <div class="col-md-3 col-xs-3 p-0">
              <div class="form-group md-form">
                  <input id="unidad" type="number" class="form-control" name="unidad" value="1">
                    <label for="unidad" class="active">{{ __('Unidad') }}</label>
                        <span class="invalid-feedback" role="alert">
                          <strong id="invalid-nombre-message"></strong>
                        </span>
              </div>
            </div>
          </div>

              <div class="row p-md-3">
                @foreach($tema->elementosCompartidos as $elemento)

              <div class="col-12">
                  <div class="row border border-primary rounded m-1" style="height: 75px !important;">
                    @if($elemento->tipo == "application/pdf")
                      <div style="background: url('{{url('public/images/pdf-background.jpg')}}');
                      background-size: cover !important; height: 73px !important; width: 125px !important; border-radius: 5px 0px 0px 5px;" class="col-4">
                      </div>
                    @else
                      <div style="background: url('{{url('public').'/'.$elemento->elemento}}');
                        background-size: cover !important; background-position: 50%; height: 73px !important; width: 125px !important; border-radius: 5px 0px 0px 5px;" class="col-4">
                      </div>
                    @endif
                    <!-- Image Description -->
                    <div class="col-8 py-2">
                      <p class="m-0 text-truncate"> {{$elemento->descripcion}}</p>
                      <b class="m-0"> 
                        @if($elemento->tipo == "application/pdf")
                          documento/pdf
                        @else
                            {{$elemento->tipo}}
                        @endif

                        </b>
                    </div>
                    <div>
                        <a class="btn shadow-none p-0" style="position: absolute; right: 25px;">
                            <i class="fa fa-times" onclick="borrarElemento('{{route('elementoscompartidos.destroy', $elemento->id)}}')"></i>
                        </a>
                    </div>  
                  </div>
                </div> 

         
                @endforeach


              <div class="col-12 mt-3"> 
                <h6 class="text-primary text-bold">
                  Enlaces compartidos
                </h6>
                  @if(count($tema->enlaces) < 1 )
                  <h6 class="mt-3">Aún no hay enlaces compártidos.</h6> 
                  @endif
                @foreach($tema->enlaces as $enlace)

                  <div class="px-sm-1 col-12">
                    <div class="row">
                          <div class="col-1">
                                <a class="btn shadow-none p-0">
                                  <i class="fa fa-times" onclick="borrarElemento('{{route('enlaces.destroy', $enlace->id)}}')"></i>
                                </a>
                          </div>
                          <div class="col-10 text-truncate">
                            <a href="{{$enlace->enlace}}" target="_blank">
                              <i class="fa fa-link">  {{ $enlace->descripcion}}.</i> </a>
                          </div>
                    </div>
                  </div>
                @endforeach
               
              </div>
          </div>

          </div>
        <div class="modal-footer">


                <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                 <div class="btn bg-primary text-white btn-sm">
                 Actualizar
                </div>
        </div>
      </div>
    </form>
    </div>
  </div>
<!-- Editar Tema Modal  -->
@endforeach


<!-- Formularios -->

<form id="borrarElemento" action="" method="POST">
    @method('delete')
    @csrf
</form>


<!-- Add Image -->
  <div class="modal fade" id="SubirArchivoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-file-upload"></i> Subir archivo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body">
          

          <form id="subirArchivo" class="dropzone" action="{{route('elementoscompartidos.store')}}" method="POST">
            @csrf
              <input id="tema_id2" type="hidden" name="tema_id2" value="{{old('tema_id2')}}">

          <div class="row">
            <div class="col-12">
              

              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                    <div class="form-group md-form">
                        <input id="descripcion" type="text" class="form-control" name="descripcion">
                        <label for="descripcion" class="text-bold active"> Descripción</label>
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong id="descripcionError"></strong>                            
                        </span>
                    </div>

                    <div class="form-group md-form pt-3">
                      <div class="row">
                        <div class="col-12 p-2 ml-2">
                          <label for="archivo" class="text-bold active text-primary"> Archivo (imagen, pdf) </label>

                        </div>
                      </div>
                      <div class="row">
                        <div class="col-10 col-sm-6 col-md-10 col-lg-6 text-center">
                         <div class="imageUpload p-0">
                            @csrf
                            <div class="dz-message needsclick text-primary text-center">
                              <i class="far fa-images fa-3x"></i>
                              <div class="spinner-border text-primary mt-4" role="status">
                            <span class="sr-only show">Loading...</span>
                          </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
        </div>

        </div>
      
      </div>
    </div>
<!-- Add Image -->

<!-- Agregar Enlace -->
  <div class="modal fade" id="CompartirEnlaceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <form action="{{route('enlaces.store')}}" method="POST">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-link"></i> Enlace </h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body">
              @csrf
              <input id="tema_id" type="hidden" name="tema_id" value="{{old('tema_id')}}">
              <input id="clase" type="hidden" name="clase" value="{{$clase->id}}">

              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                  <div class="form-group md-form">
                    <input id="descripcion2" type="text" class="form-control" name="descripcion_del_enlace" value="{{old('descripcion_del_enlace')}}">
                    <label for="descripcion2" class="text-bold active text-primary"> Descripción</label>
                    @if ($errors->has('descripcion_del_enlace'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('descripcion_del_enlace') }}</strong>                            
                        </span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                    <div class="form-group md-form">
                        <textarea id="enlace" type="text" class="form-control" name="enlace" placeholder="http://www.youtube...">{{old('enlace')}}</textarea>
                        <label for="enlace" class="text-bold active text-primary"> Enlace</label>
                    @if ($errors->has('enlace'))
                        <span class="invalid-feedback d-block mb-3 role="alert">
                            <strong>{{ $errors->first('enlace') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>


                  </div>

            <div class="modal-footer">
              <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
               <button class="btn bg-primary btn-sm text-white"> Confirmar </button>
            </div>
        </form>
        </div>
      
      </div>
    </div>

<!-- Add Image -->
<!-- Modal Windows -->


<script>


    function borrarElemento(value){
      $('#borrarElemento').attr('action', value);
      $('#borrarElemento').submit();
    }

  function cambiarTema(value){
    $("#tema_id").val(value);
    $("#tema_id2").val(value);
  }

  function filtrarParcial(value){
    $("section").hide();
    $(".unidad"+value).slideDown();
  }

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>

<script type="text/javascript">
  
  @if ($errors->has('descripcion_del_enlace') || $errors->has('enlace'))
    $("#CompartirEnlaceModal").modal('show');
  @endif
</script>

  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- DropZone -->
<script type="text/javascript" src="{{url('public')}}/dashboard/js/dropzone.js"></script>

<script type="text/javascript">
setInterval(function(){
         $("#dejarMensaje").effect( "shake", {times:4}, 1000 );
        }, 60000);  


  Dropzone.autoDiscover = false;

        //DROPZONE VARIABLE
    var uploaded = -10;
    $(".spinner-border").hide();

$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone("#subirArchivo");
  myDropzone.on("addedfile", function(file) {
    $(".fa-images").hide();
    $(".spinner-border").show();
  });

  myDropzone.on("uploadprogress", function(file, progress, bytesSent) {
      $(".fa-images").hide();
      $(".spinner-border").show();
  });

  myDropzone.on("error", function(file, progress, bytesSent) {
    $(".spinner-border").hide();
    $(".fa-images").show();

  });

    myDropzone.on("success", function(file, progress, bytesSent) {
      location.reload();
  });

})

</script>


<script>
  var lastMessage ='{!!$last!!}';
  var user_id = '{{Auth::user()->id}}';
  var user_name = '{{Auth::user()->name}}';
  var clase_id = '{!!$clase->id;!!}';
  var baseUrl = "{{url('/')}}";
  var userPhoto = '{{Auth::user()->foto}}';
 </script>
 <script src="{{url('public/js/chat.js')}}"></script>
  @endsection