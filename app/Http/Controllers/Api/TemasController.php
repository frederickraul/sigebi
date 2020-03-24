<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tema;

class TemasController extends Controller
{
    public function index(){
    	 $temas = Tema::OrderBy('updated_at','desc')->get();
    	 $datos["estado"] = 1;
         $datos["metas"] = $temas;
         print json_encode($datos);
    }

    public function show($id)
    {
        $elemento = Tema::where('id',$id)->first();
        if ($elemento) {
        	
            $tema["estado"] = "1";
            $tema["meta"] = $elemento;
            // Enviar objeto json de la meta
            print json_encode($tema);
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No hay ningun tema registrado'
                )
            );
        }

    }
}
