@extends('layouts.admin')

@section('content')

<link rel="stylesheet" type="text/css" href="{{url('/public/dashboard/')}}/css/dropzone.css">

<style type="text/css">
    @media (min-width: 768px) {
      textarea {
        height: 125px !important;
      }
    }
</style>

  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-9">
          <h1 class="h3 mb-0 text-gray-800"> 
            {{$cuestionario->tema['tema']}}
          <h4>Cuestionario</h4>
        </div>

        <div class="col-md-3">
          <div class="md-form p-0 m-0">
            
          </div>
        </div>
    </div>
    @if(session()->has('delete'))
           <div class="alert alert-warning alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('delete')}}</h4>
           </div>
    @endif   
    @if(session()->has('success'))
           <div class="alert alert-success alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('success')}}</h4>
           </div>
    @endif 
      @if(session()->has('danger'))
           <div class="alert alert-danger alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('danger')}}</h4>
           </div>
    @endif  
    @if(session()->has('warning'))
           <div class="alert alert-warning alert-dismissible mx-md-4">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

             <h4 class="h4">{{session('warning')}}</h4>
           </div>
    @endif

    <div class="row bg-white m-md-4 p-md-3 pt-3" style="min-height: 300px !important;">
      <div class="col-md-12 col-12">
            <div class="row">
              <div class="col-12 text-left">
                  <a class="btn btn-primary text-white" alt="Agregar pregunta" data-toggle="modal" data-target="#AgregarPreguntaModal">
                      <i class="fa fa-plus"> </i> Agregar
                  </a>
              </div>
            </div>


<!-- -------Preguntas------ -->
@foreach($cuestionario->preguntas as $pregunta)
        <div class="col-12" id="pregunta{{$pregunta->id}}">
            <div class="row p-3 my-3 card">
                <div class="col-12">
                   <a href="#" class="float-right ml-3" onclick="borrarElemento('{{route('preguntas.destroy', $pregunta->id)}}')">
                      <i class="fa fa-times"></i>
                  </a>

                  <a href="#" data-toggle="modal" data-target="#ModificarPreguntaModal{{$pregunta->id}}" class="float-right">
                      <i class="fa fa-pencil-alt"></i>
                  </a>

                  <h5>
                    <pre class="text-bold text-primary">{{$pregunta->pregunta}}</pre>
                  </h5>
                  
                  <a href="#" class="fa fa-images fa-2x" alt="Subir imagen (opcional)" data-toggle="modal" data-target="#SubirImagenModal" onclick="actualizarPregunta('{{$pregunta->id}}')"></a>
                  @if($pregunta->imagen['imagen'] != "")
                  <div class="row">
                      <div class="col-lg-6 mb-3">
                          <a class="float-left mr-3 text-primary">
                              <i class="fa fa-times" onclick="borrarElemento('{{route('imagenes.destroy', $pregunta->id)}}')"></i>
                          </a>
                          <img class="img-fluid" src="{{url('public').'/'.$pregunta->imagen['imagen']}}" style="height: 200px;">
                      </div>
                  </div>
                  @endif
                </div>
                <div class="col-12">
<!-- Respuesta A -->
                      <p class="p-0 m-0"> 
                         @if($pregunta->respuestas['respuesta_correcta'] == "A")
                        <i class="fas fa-check-circle text-success"></i> 
                        @else 
                        <i class="fa fa-times-circle text-danger"></i>  
                        @endif
                        A) {{$pregunta->respuestas['respuesta_A']}}   
                      </p>
<!-- Respuesta B -->
                      <p class="p-0 m-0"> 
                         @if($pregunta->respuestas['respuesta_correcta'] == "B")
                        <i class="fas fa-check-circle text-success"></i> 
                        @else 
                        <i class="fa fa-times-circle text-danger"></i>  
                        @endif
                        B) {{$pregunta->respuestas['respuesta_B']}}   
                      </p>
<!-- Respuesta C -->
                      <p class="p-0 m-0"> 
                         @if($pregunta->respuestas['respuesta_correcta'] == "C")
                        <i class="fas fa-check-circle text-success"></i> 
                        @else 
                        <i class="fa fa-times-circle text-danger"></i>  
                        @endif
                        C) {{$pregunta->respuestas['respuesta_C']}}   
                      </p>
<!-- Respuesta D -->
                      <p class="p-0 m-0"> 
                         @if($pregunta->respuestas['respuesta_correcta'] == "D")
                        <i class="fas fa-check-circle text-success"></i> 
                        @else 
                        <i class="fa fa-times-circle text-danger"></i>  
                        @endif
                        D) {{$pregunta->respuestas['respuesta_D']}}   
                      </p>
                  
                      
                </div>
            </div>
        </div>
@endforeach
         
      </div>
  </div>
<!-- /.container-fluid -->

<!-- Modal Windows -->

<!-- AgregarPreguntaModal -->
  <div class="modal fade" id="AgregarPreguntaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="{{route('preguntas.store')}}" method="POST">
          @csrf
        <div class="modal-header text-primary">
          <h5 class="modal-title"><i class="far fa-question-circle"></i> Pregunta</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 col-md-6">
              <input type="hidden" name="cuestionario_id" value="{{$cuestionario->id}}">
              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                    <div class="form-group md-form">
                        <textarea id="pregunta" type="text" class="form-control" name="pregunta">{{old('pregunta')}}</textarea> 
                        <label for="pregunta" class="text-bold active"> Pregunta</label>
                        @if ($errors->has('pregunta'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('pregunta') }} </strong>                            
                        </span>
                        @endif
                       
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group md-form">
                          <input id="respuesta_A" type="text" class="form-control" name="respuesta_A" value="{{old('respuesta_A')}}">
                          <label for="respuesta_A" class="text-primary active"> 
                          <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                          A) </label>
                               @if ($errors->has('respuesta_A'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('respuesta_A') }} </strong>                            
                        </span>
                        @endif
                       
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <input id="respuesta_B" type="text" class="form-control" name="respuesta_B" value="{{old('respuesta_B')}}">
                            <label for="respuesta_B" class="text-primary active"> 
                            <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                            B) </label>
                                 @if ($errors->has('respuesta_B'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('respuesta_B') }} </strong>                            
                        </span>
                        @endif
                        
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <input id="respuesta_C" type="text" class="form-control" name="respuesta_C" value="{{old('respuesta_C')}}">
                            <label for="respuesta_C" class="text-primary active"> 
                            <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                            C) </label>
                                @if ($errors->has('respuesta_C'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('respuesta_C') }} </strong>                            
                        </span>
                        @endif
                        
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <input id="respuesta_D" type="text" class="form-control" name="respuesta_D" value="{{old('respuesta_D')}}">
                            <label for="respuesta_D" class="text-primary active"> 
                            <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                            D) </label>
                                @if ($errors->has('respuesta_D'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('respuesta_D') }} </strong>                            
                        </span>
                        @endif
                        
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <select name="respuesta_correcta" id="respuesta_correcta" class="mt-2 form-control">
                              <option value=""> Elegir respuesta</option> 
                              <option value="A"> A</option> 
                              <option value="B"> B</option>
                              <option value="C"> C</option>
                              <option value="D"> D</option>
                            </select> 
                            <label for="respuesta_correcta" class="text-primary active text-bold"> 
                           
                            Respuesta correcta </label>
                        @if ($errors->has('respuesta_correcta'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('respuesta_correcta') }} </strong>                            
                        </span>
                        @endif
                        </div>
                      </div>
                    </div>



                  </div>
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
<!-- AgregarPreguntaModal -->

@foreach($cuestionario->preguntas as $pregunta)
<!-- ModificarPreguntaModal -->
  <div class="modal fade" id="ModificarPreguntaModal{{$pregunta->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="{{route('preguntas.update', $pregunta->id)}}" method="POST">
          @csrf
          @method('PUT')

        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-question-circle"></i> Pregunta</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body">
          
          <div class="row">
            <div class="col-12 col-md-6">
              @csrf

              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                    <div class="form-group md-form">
                        <textarea id="modificar_pregunta{{$pregunta->id}}" type="text" class="form-control" name="modificar_pregunta">{{$pregunta->pregunta}}
                        </textarea> 
                        <label for="modificar_pregunta{{$pregunta->id}}" class="text-bold active"> Pregunta</label>
                            
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group md-form">
                          <input id="modificar_respuesta_A{{$pregunta->id}}" type="text" class="form-control pl-4" name="modificar_respuesta_A" value="{{$pregunta->respuestas['respuesta_A']}}">
                          <label for="modificar_respuesta_A{{$pregunta->id}}" class="text-primary active"> 
                          <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                          A) </label>
                              
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <input id="modificar_respuesta_B{{$pregunta->id}}" type="text" class="form-control pl-4" name="modificar_respuesta_B" value="{{$pregunta->respuestas['respuesta_B']}}">
                            <label for="modificar_respuesta_B{{$pregunta->id}}" class="text-primary active"> 
                            <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                            B) </label>
                               
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <input id="modificar_respuesta_C{{$pregunta->id}}" type="text" class="form-control pl-4" name="modificar_respuesta_C" value="{{$pregunta->respuestas['respuesta_C']}}">
                            <label for="modificar_respuesta_C{{$pregunta->id}}" class="text-primary active"> 
                            <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                            C) </label>
                               
                        </div>
                      </div>
                    </div>

                    <div class="row">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <input id="modificar_respuesta_D{{$pregunta->id}}" type="text" class="form-control pl-4" name="modificar_respuesta_D" value="{{$pregunta->respuestas['respuesta_D']}}">
                            <label for="modificar_respuesta_D{{$pregunta->id}}" class="text-primary active"> 
                            <img src="{{url('public/images/radio-button.png')}}" style="width: 20px; ">
                            D) </label>
                               
                        </div>
                      </div>
                    </div>

                    <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group md-form">
                            <select name="modificar_respuesta_correcta" class="mt-2 form-control">
                              <option value="A" 
                              {{ ( "A" == $pregunta->respuestas['respuesta_correcta']) ? 'selected' : '' }}> A</option> 
                              <option value="B"
                              {{ ( "B" == $pregunta->respuestas['respuesta_correcta']) ? 'selected' : '' }}> B</option>
                              <option value="C" 
                              {{ ( "C" == $pregunta->respuestas['respuesta_correcta']) ? 'selected' : '' }}> C</option>
                              <option value="D" 
                              {{ ( "D" == $pregunta->respuestas['respuesta_correcta']) ? 'selected' : '' }}> D</option>
                            </select> 
                            <label class="text-primary active text-bold"> 
                           
                            Respuesta correcta </label>
                                
                        </div>
                      </div>
                    </div>



                  </div>
                </div>
            </div>

          </div>

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
           <button type="submit" class="btn bg-primary btn-sm text-white"> Actualizar </button>
        </div>
        </form>
        </div>
      
      </div>
    </div>
<!-- ModificarPreguntaModal -->
@endforeach


<!-- Add Image -->
  <div class="modal fade" id="SubirImagenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header text-primary">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-images"></i> Subir imagen</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-primary">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              

              <div class="row m-0 p-0">
                <div class="col-md-12 col-xs-12 p-2">

                    <div class="form-group md-form pt-3">
                      <div class="row">
                        <div class="col-12 p-2 ml-2">
                          <label for="archivo" class="text-bold active text-primary"> Imagen </label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-10 col-sm-6 col-md-10 col-lg-6">
                      <form id="SubirImagenForm" class="dropzone imageUpload p-0" action="{{route('imagenes.update',1)}}" method="POST">
                      @csrf
                      @method('PUT')  
                      <input id="pregunta_id" type="hidden" name="pregunta_id" value="">      
                            <div class="dz-message needsclick text-primary text-center">
                              <i class="far fa-images fa-3x"></i>
                            </div>
                        </form>

                          </div>
                        </div>
                        
                      </div>

                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancelar</button>
        </div>

        </div>
      
      </div>
    </div>
<!-- Add Image -->

<!-- Formularios -->
<form id="borrarElemento" action="" method="POST">
    @method('delete')
    @csrf
</form>

<!-- DropZone -->
<script type="text/javascript" src="{{url('public')}}/dashboard/js/dropzone.js"></script>


<script type="text/javascript">
//DROPZONE VARIABLE
  var uploaded = 0;

  function borrarElemento(url){

      $('#borrarElemento').attr('action', url);
      $('#borrarElemento').submit();
  }

  function actualizarPregunta(value){
      $('#pregunta_id').val(value);
      console.log(value);
  }

//Ventana modal de agregar pregunta
@if ($errors->has('pregunta') || $errors->has('respuesta_A') || $errors->has('respuesta_B') || $errors->has('respuesta_C') || $errors->has('respuesta_D') || $errors->has('respuesta_correcta'))
  $("#AgregarPreguntaModal").modal('show');
@endif

function editElement(id){
  location.href ='alumnos/'+id+'/edit';
}

function deleteElement(id){
  var id = id;
  url = '{!!url("/api/alumnos")!!}'+"/"+id;
  $.ajax({
    url: url,
    type: 'GET',
    success: function(data){
      $("#id").val(data.id);
      $("#nombre").html("<b>Nombre: </b>"+data.nombre+","+data.apellido);
      $("#matricula").html("<b>Matrícula: </b>"+data.matricula);
    }
  });

  $("#deleteForm").attr('action','alumnos/'+id);
  $('#confirmDeleteModal').modal('show');
}
 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>
  @endsection