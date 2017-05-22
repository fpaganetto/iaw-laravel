<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Compartir as Compartir;

class PrecargadosController extends Controller
{
    public function json(){
		return Compartir::where('iduser','0')->get();
	}
}
