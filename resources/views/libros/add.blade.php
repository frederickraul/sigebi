@extends('layouts.admin')

@section('content')
<style type="text/css">
    .bg-login-image{
    background-image: url('{{url('resources/')}}/img/undraw/undraw_Books_l33t.svg') !important;
    background-position: center 10% !important;
    background-size: 80%;
    background-repeat: no-repeat;
  }
  .btn-primary{
    cursor: pointer;
  }




</style>
  <div class="container-fluid">
        <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-6">
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a>
          <a href="{{url('/libros')}}"> / Libros </a> / Registrar
           <i class="fas fa-book"></i><sup><i class="fas fa-plus"></i></sup></h1>
        </div>
    </div>
        <!-- Nested Row within Card Body -->
		    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>

          <div class="col-lg-6">

        
            <div class="p-lg-5 p-3">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-5">¡Registrar libro!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('libros.store') }}" aria-label="{{ __('Register') }}">
              	  @csrf
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-uppercase form-control{{ $errors->has('clasificacion') ? ' is-invalid' : '' }}" value="{{ old('clasificacion') }}" id="clasificacion" name="clasificacion" readonly="true"> 
                      <label class="pl-2" style="transform: translateY(-14px) scale(0.8); }">Clasificación</label>
                    </div>
                  
                      @if ($errors->has('clasificacion'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('clasificacion') }} Intenta agregar número de ejemplar.</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>
<!-- Titulo -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-capitalize form-control{{ $errors->has('titulo') ? ' is-invalid' : '' }}" value="{{ old('titulo') }}" id="titulo" name="titulo"> 
                      <label for="titulo" class="text-bolder{{ old('titulo') != '' ? ' active' : '' }}"><i class="text-danger"> * </i>Título</label>
                    </div>
                  
                      @if ($errors->has('titulo'))
                        <span class="invalid-feedback d-block mb-1" role="alert">
                            <strong>{{ $errors->first('titulo') }}</strong>                            
                        </span>
                    @endif
                    </div>
                  </div>
                </div>
<!-- Titulo -->
                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="text" class="text-capitalize form-control" value="{{ old('subtitulo') }}" id="subtitulo" name="subtitulo"> 
                      <label for="subtitulo" class="pl-2 text-bolder{{ old('subtitulo') != '' ? ' active' : '' }}">Subtítulo</label>
                    </div>
                    </div>
                  </div>
                </div>
                <div class="form-group ">
                  <div class="row m-0 p-0">
                    <div class="col-md-8 col-xs-8 p-0"> 
                      <div class="md-form">
                          <label class="text-danger text-bolder"> * </label>
                          <select class="text-capitalize text-bolder ml-2 form-control{{ $errors->has('autor') ? ' is-invalid' : '' }}
                          {{ (old('autor') == '') ? ' empty' : '' }}" name="autor" id="autor">
                            <option value=""> Autor</option>
                            @foreach($autores as $autor)
                              <option value="{{$autor->id}}" 
                                {{ (old('autor') == $autor->id) ? 'selected' : '' }}> @if($autor->apellido != ""){{$autor->apellido.", "}}@endif{{$autor->nombre}}</option>
                            @endforeach
                           
                          </select>
                          @if ($errors->has('autor'))
                            <span class="invalid-feedback d-block mb-1" role="alert">
                                <strong>{{ $errors->first('autor') }}</strong>
                            </span>
                            @endif
                      </div>
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0 pl-5">
                        <div id="modelButton" class="btn text-white bg-primary text-center" alt="Registrar Autor" data-toggle="modal" data-target="#modal-registrarAutor">
                          <i class="fa fa-plus"></i></div>
                      </div> 
                  </div>
                </div>                

                <p class="mb-0 pb-0 pl-2 text-bolder">Categoría</p>
                <div class="row px-3">
                  <div class="col-md-9 col-xs-9 border">
                <div class="form-group m-0 p-0">
                  <div class="row m-0 p-0">
                    <div class="col-md-11 col-xs-11 p-0"> 
                      <div class="md-form">
                          <label class="text-danger"> * </label>
                          <select class="ml-2 form-control{{ $errors->has('nivel_1') ? ' is-invalid' : '' }}
                          {{ (old('nivel_1') == '') ? ' empty' : '' }}" name="nivel_1" id="nivel_1">
                            <option value=""> Nivel 1</option>
                            @foreach($categorias as $categoria)
                              <option value="{{$categoria->id}}" 
                                {{ ( old('nivel_1') == $categoria->id && old('nivel_1') !='' ) ? 'selected' : '' }}> {{$categoria->concepto}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('nivel_1'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $errors->first('nivel_1') }}</strong>
                            </span>
                            @endif
                      </div>
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
  
                      </div> 
                  </div>
                </div>
                <div class="form-group m-0 p-0">
                  <div class="row m-0 p-0">
                    <div class="col-md-11 col-xs-11 p-0"> 
                      <div class="md-form">
                          <label class="text-danger"> * </label>
                          <select class="ml-2 form-control{{ $errors->has('nivel_2') ? ' is-invalid' : '' }}" name="nivel_2" id="nivel_2">
                            <option value=""> Nivel 2</option>
                          </select>
                          @if ($errors->has('nivel_2'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nivel_2') }}</strong>
                            </span>
                            @endif
                      </div>
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
  
                      </div> 
                  </div>
                </div>
                <div class="form-group m-0 p-0">
                  <div class="row m-0 p-0">
                    <div class="col-md-11 col-xs-11 p-0"> 
                      <div class="md-form">
                          <label class="text-danger"> * </label>
                          <select class="ml-2 form-control{{ $errors->has('nivel_3') ? ' is-invalid' : '' }}" name="nivel_3" id="nivel_3">
                            <option value=""> Nivel 3</option>
                           
                          </select>
                          @if ($errors->has('nivel_3'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nivel_3') }}</strong>
                            </span>
                            @endif
                      </div>
                    </div>  
                     <div class="col-md-3 col-xs-3 pr-0">
  
                      </div> 
                  </div>
                </div>  
                  </div>
                  
                </div>              

<!-- Titulo -->
                <div class="form-group pt-3">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="number" class="text-capitalize form-control{{ $errors->has('paginas') ? ' is-invalid' : '' }}" value="{{ old('paginas') }}" id="paginas" name="paginas"> 
                      <label for="paginas" class="pl-2 text-bolder{{ old('paginas') != '' ? ' active' : '' }}"> Páginas</label>
                    </div>
                  
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="number" class="text-capitalize form-control{{ $errors->has('ejemplar') ? ' is-invalid' : '' }}" value="{{ old('ejemplar') }}" id="ejemplar" name="ejemplar"> 
                      <label for="ejemplar" class="pl-2 text-bolder{{ old('ejemplar') != '' ? ' active' : '' }}"> Ejemplar</label>
                    </div>

                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row m-0 p-0">
                    <div class="col-md-9 col-xs-9">
                      <div class="md-form">
                      <input type="number" class="text-capitalize form-control{{ $errors->has('volumen') ? ' is-invalid' : '' }}" value="{{ old('volumen') }}" id="volumen" name="volumen"> 
                      <label for="volumen" class="pl-2 text-bolder{{ old('volumen') != '' ? ' active' : '' }}"> Volumen</label>
                    </div>
                    </div>
                  </div>
                </div>
                <input id="iniciales" type="hidden" name="iniciales" value="{{ old('iniciales') }}">
                <hr>
                    <div class="form-group text-right pt-3">
                 <button type="submit" class="btn text-white bg-primary btn-sm">
                       {{ __('Registrar') }}
                    </button>
                   </div>
              </form>
            </div>
          </div>
        </div>

  </div>

<!-- Modal Section -->

    <!-- Modal Add Model -->
  <div class="modal fade" id="modal-registrarAutor" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form id="addAutorForm">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">¿Necesitas registrar un autor?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="nombre" type="text" class="form-control" name="nombre">
                    <label for="nombre" >{{ __('Nombre del autor') }}</label>
                        <span class="invalid-feedback invalid-nombre" role="alert">
                          <strong id="invalid-nombre-message"></strong>
                        </span>
              </div>
            </div>
          </div>
          <div class="row m-0 p-0">
            <div class="col-md-12 col-xs-12 p-0">
              <div class="form-group md-form">
                    <input id="apellido" type="text" class="form-control" name="apellido">
                    <label for="apellido">{{ __('Apellido del autor') }}</label>
                        <span class="invalid-feedback invalid-apellido" role="alert">
                          <strong id="invalid-apellido-message"></strong>
                        </span>
                </div>
              </div>
            </div>
          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <div class="btn bg-primary text-white btn-sm" onclick="addAutor()">
            {{ __('Register') }}
          </div>
        </div>
      </div>
    </form>
    </div>
  </div>
  <!-- Modal Add Autor -->


<script type="text/javascript">
  var nivel_1;
  var nivel_2       = '{!! old('nivel_2') !!}';
  var nivel_3       = '{!! old('nivel_3') !!}';
  var autor         ='{!! old('autor') !!}';
  var clasificacion;
  var categoria;

  if(nivel_3 < 10){
    categoria ='00'+ nivel_3;
  }
  else if(nivel_3 < 100){
    categoria ='0'+ nivel_3;
  }
  else{
    categoria = nivel_3;
  }
  var ini           = '{!! old('iniciales') !!}';
  var volumen       ="";
  var ejemplar      ="";
   $(document).ready(function(){
      nivel_1 = $("#nivel_1").find('option:selected').val();
      if(nivel_1 != ''){
        generateNivel2();
        if(nivel_2 != ''){
        generateNivel3();
      }
      }
      
  });

     $( "#volumen" ).on("input", function () { 
     if(this.value != ""){ 
      volumen = " V."+this.value;
      }else{
        volumen = "";
      }
      calcularClasificacion();
     });  

      $( "#ejemplar" ).on("input", function () {  
        if(this.value != ""){
          ejemplar = " E."+this.value;
        }else{
          ejemplar ="";
        }
        
      calcularClasificacion();
     });

     $( "select" ).change(function () {    
    id = $(this).closest('select').attr('id');
    value = $("#"+id).val();
      switch(id){
        case "nivel_1":
        nivel_1 = $(this).find('option:selected').val();
        console.log(nivel_1);
        if(nivel_1 == ""){
            $('#nivel_2').empty();
            $('#nivel_2').append('<option value=""> Nivel 3</option>');
          }
          else{
            generateNivel2();
          }
          //Limpiamos el Nivel 3
          $('#nivel_3').empty();
          $('#nivel_3').append('<option value=""> Nivel 3</option>');
        break;
        case "nivel_2":
        nivel_2 = $(this).find('option:selected').val();
        console.log(nivel_2);
        if(nivel_1 == ""){
           $("#nivel_3").prop("disabled", true);
          }
          else{
            $("#nivel_3").prop("disabled", false);
                        generateNivel3();
          }
        break;
         case "nivel_3":
        nivel_3 = $(this).find('option:selected').val();
        if(nivel_3 < 10){
          nivel_3 ='00'+ nivel_3;
        }
        else if(nivel_3 < 100){
           nivel_3 ='0'+ nivel_3;
        }
        categoria = nivel_3;
        calcularClasificacion()
        break;
        case "autor":
        autor = $(this).find('option:selected').text();
        value = clearSpace(autor);
        console.log(value);
        ini = value.substring(0,3);
        $("#iniciales").val(ini);
        calcularClasificacion()
        break;
        }
      });

     function calcularClasificacion(){
        clasificacion = categoria + ini + volumen + ejemplar;
        console.log(clasificacion);
        $("#clasificacion").val(clasificacion);
     }

    function generateNivel2() {
      $('#nivel_2').empty();
      $('#nivel_2').append('<option value=""> Nivel 2</option>');
      url = localurl+"/api/categorias/nivel2/"+nivel_1;

      $.ajax({
        type:"GET",
        url: url,
        success: function(data){
          $(data).each(function(index, model){
             //year = '<a class="dropdown-item" data="'+year.number+'">'+year.number+'</a>';
            $('#nivel_2').append($('<option>',
             {
                value: model['id'],
                text :  model['concepto']
              }
            )
            );
          });
          $("#nivel_2 option[value='"+nivel_2+"']").prop('selected', true);
        }
      });
    }    

    function generateNivel3() {
      $('#nivel_3').empty();
      $('#nivel_3').append('<option value=""> Nivel 3</option>');
      url = localurl+"/api/categorias/nivel3/"+nivel_2;

      $.ajax({
        type:"GET",
        url: url,
        success: function(data){
          $(data).each(function(index, model){
             //year = '<a class="dropdown-item" data="'+year.number+'">'+year.number+'</a>';
            $('#nivel_3').append($('<option>',
             {
                value: model['id'],
                text :  model['concepto']
              }
            )
            );
          });
          $("#nivel_3 option[value='"+nivel_3+"']").prop('selected', true);
        }
      });
    }
function  clearSpace(cadena){
  cadena = cadena.trim();
  cadena1 = cadena.replace('.','');
  cadena2 = cadena1.replace(',','');
  cadena3 = cadena2.replace(' ','');

  return cadena3;
}
function addAutor(){
       var formDataValues = document.forms.namedItem("addAutorForm");
            var formValues = new FormData(formDataValues);
                url = localurl+"/api/autores";
                $.ajax({
                    type: 'POST',
                    url: url,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formValues,
                    success: function (data){
                      if(data.errors == "repetido"){
                        $("#autor option[value='"+data.id+"']").prop('selected', true);
                        $('#modal-registrarAutor').modal('hide');
                        $('#autor').removeClass('empty');  
                      }
                      else{
                        if(data.apellido != ""){
                           name = clearSpace(data.apellido+", "+data.nombre);
                           ini = name.substring(0,3);

                           $('#autor').append($('<option>',
                           {
                              value: data.id,
                              text : " "+data.apellido+", "+data.nombre
                            }));
                        }
                        else{
                           ini = data.nombre.substring(0,3);
                           $('#autor').append($('<option>',
                           {
                              value: data.id,
                              text : " "+data.nombre
                            }));
                        }
                      $("#autor option[value='"+data.id+"']").prop('selected', true);
                        $('#modal-registrarAutor').modal('hide');
                        $('#autor').removeClass('empty');                      
                        //Calculamos iniciales
                         $("#iniciales").val(ini);
                        calcularClasificacion()

                      }
                     
                    },
                    error: function(e) {
                      console.log(e);
                      response = e.responseJSON;
                      console.log(response);
                      $('#addAutorForm .invalid-nombre').show();
                       $('#addAutorForm .invalid-apelldo').show();
                      $('#addAutorForm #invalid-nombre-message').text(response.errors.nombre);
                      $('#addAutorForm #invalid-apellido-message').text(response.errors.apellido);
                      $('#addAutorForm #nombre').addClass('is-invalid');
                      $('#addAutorForm #apellido').addClass('is-invalid');
                    }});
    }
</script>
@endsection