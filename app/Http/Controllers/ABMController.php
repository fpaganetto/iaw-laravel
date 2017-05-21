<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ABMController extends Controller{
    public function borrar($categoria, $elemento){
		DB::table($categoria)->where('valor', '=', $elemento)->delete();
    }
}
