<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use App\Periodo;

class PeriodosController extends Controller
{
    public function list(){
         return DataTables::of(Periodo::query()->OrderBy('year','desc')->OrderBy('semestre','desc'))->make(true);
    }
}
