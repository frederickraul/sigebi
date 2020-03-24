<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Grupo;

class GruposController extends Controller
{
    public function list(){
         return DataTables::of(Grupo::query()->OrderBy('grupo'))->make(true);
    }
}
