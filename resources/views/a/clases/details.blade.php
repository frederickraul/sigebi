@extends('layouts.student')

@section('content')
<link rel="stylesheet" type="text/css" href="{{url('/public/dashboard/')}}/css/dropzone.css">
<link rel="stylesheet" type="text/css" href="{{url('/public/')}}/css/modal-chat.css">

<style type="text/css">
  .tema{
    transition: .3s ease-in-out .0s;
  }
  .tema:hover{
  }

  .dropzone{
    border: none !important;
  }



</style>

<!-- Begin Page Content -->
  <div class="container-fluid">
    <div class="card card-image" style="background-image: url({{url('public/images/gradient5.jpg')}});">
      <div class="text-white text-center px-4">
        <div>
          <h2 class="card-title h1-responsive pt-3 font-bold"><strong class="text-capitalize">
            {{$clase->asignatura['slug']}}</strong></h2>
          <h4>Raúl Suchilt Fonseca</h4>
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
          <h2 class="text-center mt-3">Aún no hay temas asignados en esta clase.</h2> @endif
          <!--Section: Temas Box-->
         
          @foreach($temas as $tema)

        <section id="tema{{$tema->id}}" class="unidad{{$tema->parcial}} border-bottom tema">
          <div class="row">
<!-- Col -->
            <div class="col-md-6">
              <div class="media mt-4 px-1">
                <img class="card-img-100 rounded-circle d-flex z-depth-1 mr-3" src="{{url('/resources')}}/img/users/zak2.png"
                  alt="Generic placeholder image">
                <div class="media-body">

                  <h6 class="font-weight-bold mt-0">
                    <a href="#tema{{$tema->id}}" class="text-default" href="#"><b>Tema: </b> {{$tema->tema}}</a>
                  </h6>
                  <i>Parcial {{$tema->parcial}} </i> -
                  <i>Unidad {{$tema->unidad}} </i>
                  <br>

                  <i class="fa fa-clock "> </i> {{$tema->updated_at->diffForHumans()}}
                  <br>                 
                </div>
              </div>

              <div class="row p-md-3">
              <div class="col-12 mt-3 mb-3"> 
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


                <div class="col-12">
                  <h6 class="text-primary text-bold">
                  Recursos
                </h6>
                  @if(count($tema->elementosCompartidos) < 1 )
                  <h6 class="mt-3">Aún no hay recursos disponibles.</h6> 
                  @endif
                </div>
                @foreach($tema->elementosCompartidos as $elemento)
               
              <div class="col-12">
                <a href="{{url('public').'/'.$elemento->elemento}}">
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
                  </div>
                  </a>
                </div>            
                @endforeach
              </div>    
            </div>
<!-- Col -->    
            <div class="col-md-6">
              <h6 class="text-primary text-bold mt-4 px-1">
                  Actividades
                </h6>
                  @if(count($tema->actividades) < 1 )
                  <h6 class="mt-3">Aún no hay actividades registradas.</h6> 
                  @endif
                @foreach($tema->actividades as $actividad)

                  <div class="px-sm-4 col-12 my-2">
                    <div class="row border border-primary rounded m-1>
                      <div class="col-12">
                        <a href="{{url('a/actividades').'/'.$actividad->id}}">
                          <small class="float-right text-sm px-2 ml-4"> Publicado {{ $actividad->updated_at->diffForHumans()}}</small>
                          <p class="fas fa-task text-left px-2"> {{ $actividad->titulo}}.</p> </a>
                      </div>

                    </div>
                  
                @endforeach
            </div> 
          
          </div>    
        </section>
        @endforeach
      <!--Section: Temas Box-->
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
                          <i class="userName"></i>
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
  </div>






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
          <form class="dropzone" action="{{route('elementoscompartidos.store')}}" method="POST">
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
                        <div class="col-10 col-sm-6 col-md-10 col-lg-6">
                         <div class="imageUpload p-0">
                            @csrf
                            <div class="dz-message needsclick text-primary text-center">
                              <i class="far fa-images fa-3x"></i>
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

<!-- Modal Windows -->

  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- DropZone -->
<script type="text/javascript" src="{{url('public')}}/dashboard/js/dropzone.js"></script>

<script type="text/javascript">
setInterval(function(){
         $("#dejarMensaje").effect( "shake", {times:4}, 1000 );
        }, 60000);  


      //DROPZONE VARIABLE
    var uploaded = 0;

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
  

<script>
  var lastMessage ='{!!$last!!}';
  var user_id = '{{Auth::user()->id}}';
    var user_name = '{{Auth::user()->name}}';
  var clase_id = '{!!$clase->id;!!}';
  var baseUrl = "{{url('/')}}";
  var userPhoto = '{{Auth::user()->foto}}';
  var userName = '{{Auth::user()->name}}';

 </script>
 <script src="{{url('public/js/chat.js')}}"></script>
  @endsection