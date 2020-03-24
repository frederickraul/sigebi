@extends('layouts.student')

@section('content')
<!--Import Google Fonts-->
<link href="https://fonts.googleapis.com/css?family=Material+Icons|Roboto:300,400,500" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="{{url('/')}}/public/dashboard/vendor/stepper/css/mstepper.css" media="screen,projection" />

<link type="text/css" rel="stylesheet" href="{{ url('public/dashboard/vendor/stepper/css/materialize.css')}}" media="screen,projection" />



<!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-9">
          <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Principal</a> / Examen
           <i class="fas fa-user-graduate"></i><sup><i class="fas fa-check"></i></sup></h1>
        </div>

        <div class="col-md-3">
         
        </div>
    </div>
     @if(session()->has('delete'))
           <div class="alert alert-warning mx-md-4">
             <h4 class="h4">{{session('delete')}}</h4>
           </div>
     @endif
     <div>
       
  
     </div
        <div class="" id="demos">
           <div id="demos_linear">
      <div class="row bg-white m-md-4 p-md-3">
      <div class="col-md-8 px-0 px-sm-3 col-12">
        <form method="POST" action="{{route('examen.store')}}">
          @csrf
                 <div class="card">
                    <div class="card-content">
                       <ul class="stepper linear demos">
                              @foreach($preguntas as $key=>$pregunta)

                          <li class="step nav-link">
                             <div class="step-title waves-effect waves-dark pb-1">Pregunta {{$key+1}}</div>

                             <div class="step-content">
                                <div class="row">
                                   <div class="col s12 md-form">
                                    <h6 class="active m-0 text-gray-800">{{$pregunta->pregunta}}</h6>
                                      <select class="form-control" id="sel{{$key+1}}" 
                                      name="sel{{$key+1}}" class="validate" required>
                                        <option value="">Elegir respuesta</option>
                                        <option value="A">
                                          {{$pregunta->respuestas['respuesta_A']}}
                                        </option>
                                        <option value="B">
                                          {{$pregunta->respuestas['respuesta_B']}}
                                        </option>
                                        <option value="C">
                                          {{$pregunta->respuestas['respuesta_C']}}
                                        </option>
                                        <option value="D">
                                          {{$pregunta->respuestas['respuesta_D']}}
                                        </option>

                                      </select>
                                      <input type="hidden" name="res{{$key+1}}" value="{{$pregunta->respuestas['respuesta_correcta']}}">
                                   </div>
                                </div>
                                <div class="step-actions">
                                   <button class="waves-effect waves-dark btn bg-primary text-white btn-sm next-step">CONTINUE</button>
                                </div>
                             </div>
                          </li>
                          @endforeach
                         
                          <li class="step nav-link">
                             <div class="step-title waves-effect waves-dark">Fin</div>
                             <div class="step-content">
                                Terminar!
                                <div class="step-actions">
                                   <button class="waves-effect waves-dark btn bg-primary text-white btn-sm " type="submit">Enviar</button>
                                </div>
                             </div>
                          </li>
                        
                       </ul>
                    </div>
                 </div>
            </form>
          </div>
        </div>
      </div>
  </div>
  
</main>




   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="{{url('/')}}/public/dashboard/vendor/stepper/js/mstepper.js"></script>

<script>


   var domSteppers = document.querySelectorAll('.stepper.demos');
   for (var i = 0, len = domSteppers.length; i < len; i++) {
      var domStepper = domSteppers[i];
      new MStepper(domStepper);
   }

   function someFunction(destroyFeedback) {
      setTimeout(function () {
         destroyFeedback(true);
      }, 1000);
   }
</script>



  @endsection