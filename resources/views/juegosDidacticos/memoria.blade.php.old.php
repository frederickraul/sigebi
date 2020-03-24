@extends('layouts.admin')

@section('content')

<script src="https://cdn.rawgit.com/nnattawat/flip/master/dist/jquery.flip.min.js"></script>

<style type="text/css">
  #juego {
    width: 600px;
    height: 600px;
}

table {
    width: 100%;
    height: 100%;
}

td {
    width: 25%;
    height: 25%;
    background-color: black;
    border: 3px solid white !important;
    border-radius: 5px;
}

.letra {
    color: white;
    font-size: 40px;
    text-align: center;
    font-style: italic;
}

input {
    width: 90px;
    height: 30px;
}

.centrar {
    margin-left: 210px;
}
  
</style>

<script type="text/javascript">
  
var cartas = new Array( 
  {nombre: '1', seleccion: false}, {nombre: '2', seleccion: false}, 
  {nombre: '3', seleccion: false}, {nombre: '4', seleccion: false}, 
  {nombre: '5', seleccion: false}, {nombre: '6', seleccion: false}, 
  {nombre: '7', seleccion: false}, {nombre: '8', seleccion: false}, 
  {nombre: '1', seleccion: false}, {nombre: '2', seleccion: false}, 
  {nombre: '3', seleccion: false}, {nombre: '4', seleccion: false}, 
  {nombre: '5', seleccion: false}, {nombre: '6', seleccion: false}, 
  {nombre: '7', seleccion: false}, {nombre: '8', seleccion: false} );
        
var intentos = 0;
var jugada1 = "";
var jugada2 = "";
var identificadorJ1 = "";
var identificadorJ2 = "";

function iniciarJuego () {  
  var dato = document.getElementById("juego");
  dato.style.opacity = 1;

  cartas.sort(function() {return Math.random() - 0.5});
  for ( var i = 0 ; i < 16 ; i++ ) {
    var carta = cartas[i].nombre;
    var dato = document.getElementById( i.toString() );
    dato.dataset.valor = carta;
  }
};

function resetearJuego () {
  cartas.sort(function() {return Math.random() - 0.5});
  for ( var i = 0 ; i < 16 ; i++ ) {
    var carta = cartas[i].nombre;
    var dato = document.getElementById( i.toString() );
    dato.dataset.valor = carta;
    colorCambio( i, '#444444', '?');
  } 
}

function girarCarta () {
  var evento = window.event;

  jugada2 = evento.target.dataset.valor;
  identificadorJ2 = evento.target.id;


  if ( jugada1 !== "" ) {

    if ( jugada1 === jugada2 && identificadorJ1 !== identificadorJ2 && cartas[parseInt(identificadorJ2)].seleccion != true &&               cartas[parseInt(identificadorJ1)].seleccion != true) {
      
      cartas[parseInt(identificadorJ1)].seleccion = true;
      cartas[parseInt(identificadorJ2)].seleccion = true;

      colorCambio(identificadorJ2, "#0015EE", jugada2);
      vaciar();
      comprobar();
    }else if(identificadorJ1 !== identificadorJ2){
      var self = this;
      setTimeout(function(){
        colorCambio(self.identificadorJ1, "#444444", "?")
        colorCambio(self.identificadorJ2, "#444444", "?")
        vaciar()
      },200); 

      colorCambio(identificadorJ2, "#0015EE", jugada2);
    }
  } else if(jugada2 !== "valor") {

    colorCambio(identificadorJ2, "#0015EE", jugada2);

    jugada1 = jugada2;
    identificadorJ1 = identificadorJ2;
  }
};

function vaciar ()  {
  jugada1 = ""; 
  jugada2 = ""; 

  identificadorJ1 = "";
  identificadorJ2 = "";
}

function colorCambio (posicion, color, contenido) {
  document.getElementById(posicion.toString()).style.backgroundColor = color;
  document.getElementById(posicion.toString()).innerHTML = contenido;
}   

function comprobar () {
  var aciertos = 0;
  for( var i = 0 ; i < 16 ; i++ ){
    if ( cartas[i].seleccion == true ) {
      aciertos ++;
    }

  }

  if(aciertos == 16){
    document.getElementById("juego").innerHTML = "GANASTE";
  }
}

function resetearJuego () {
            cartas.sort(function() { return Math.random() - 0.5});
            for ( var i = 0; i < 16 ; i++ ) {
                var carta = cartas[i].nombre;
                var dato = document.getElementById( i.toString() );
                dato.dataset.valor = carta;
                colorCambio(i, '#0015EE', '?');
            }
        };
</script>



<!-- Begin Page Content -->
  <div class="container-fluid">
      <div class="row">
       <div class="memory-card"> 
  <div class="front p-5 bg-danger text-white"> 
    Front content
  </div> 
  <div class="back p-5 bg-info text-white">
    Back content
  </div> 
</div>
<script type="text/javascript">
  $(".memory-card").flip();
</script>
      </div>
    <!-- Page Heading -->
    <div class="row bg-white m-md-4 p-md-3 pt-3">
        <div class="col-md-12">
                  <h1 class="h3 mb-0 text-gray-800"><a href="{{url('/')}}">Juego de memoria</a></h1>

        </div>
      
    </div>
          <!-- Color System -->
          <div class="row bg-white m-md-4 p-md-3">

            <div class="col-lg-12 mb-4">

              <!-- Illustrations -->
              <div class="">

                <div class="card-body">
                    <div class="centrar">
    <input class="btn btn-info" type="button" value="Iniciar" onclick="iniciarJuego()" />    
    <input class="btn btn-info" type="button" value="Reset" onclick="resetearJuego()" /> 
  </div>
                  <div id="juego">
          <table>
        <tr>
          <td id="0" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="1" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="2" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="3" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
        </tr>
        <tr>
          <td id="4" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="5" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="6" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="7" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
        </tr>
        <tr>
          <td id="8" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="9" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="10" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="11" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
        </tr>
        <tr>
          <td id="12" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="13" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="14" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
          <td id="15" class="letra" onclick="girarCarta()" data-valor="valor">?</td>
        </tr>
            </table>
      </div>

                  
                </div>
              </div>

            </div>
          </div>

  </div>



<!-- /.container-fluid -->
<!-- Modal Windows -->
  <!-- Modal Delete Car -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="exampleModalLabel">Need to delete the car?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-body"> 
          @csrf
            <h6 class="h6" id="stock">Stock</h6>
            <h6 class="h6">Are you sure?</h6>
            <input name="_method" type="hidden" value="delete">

          </div>
        <div class="modal-footer">
          <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
           <button class="btn btn-primary btn-sm"> Confirm </button>
          </div>
        </div>
          </form>
      </div>
    </div>
<!-- Modal Windows -->


<!-- MDBootstrap Datatables  -->
<script type="text/javascript" src="{{url('public')}}/js/addons/datatables-es.js"></script>
 <script type="text/javascript">
        $.extend( $.fn.dataTable.defaults, {
            language: {
                "processing": "Buscando. Por favor espere..."
            },
         
        });
    </script>
    <script type="text/javascript">
        var action = '<button data-toggle="tooltip" title="Actualizar" class="pd-setting-ed text-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'+'<button data-toggle="tooltip" title="Eliminar" class="pd-setting-ed text-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
    var table = $('#BooksTable').DataTable(
        {
        processing: true,
        serverSide: true,
        ajax: '{!! url("books-data") !!}',
        columns: [
            { data: 'numero', name: 'numero'},
            { data: 'clasificacion', name: 'clasificacion', class : "text-uppercase"},
            { data: 'titulo', name: 'titulo', class : "text-uppercase"},
            { data: 'estado', name: 'estado' },
            { data: 'autor', name: 'autor' },
            { data: 'volumen', name: 'volumen' },
            { data: 'ejemplar', name: 'ejemplar' },
            { data: 'estado', name: 'estado' },
        ]
    });

 
// #myInput is a <input type="text"> element
$('#SearchBook').on( 'keyup', function () {
    table.search( this.value ).draw();
} );
</script>


<script type="text/javascript">
  $("#card").flip({
  axis: 'x',
  trigger: 'hover'
});
</script>
  @endsection