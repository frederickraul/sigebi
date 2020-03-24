<?php

namespace App\Http\Controllers\Alumnos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Grupo;

class AuthController extends Controller
{
	
    public function register(){
    	$grupos = Grupo::all();
    	return view('a.auth.register', compact('grupos'));
    }
}
