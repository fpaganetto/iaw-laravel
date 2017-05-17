<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Personalizables extends Model
{
    public static function p(){
		// $colores = DB::table('colores')->pluck("colors","valores");
		// $colores = DB::table('personalizables')->get();

		// Log::info();

		// $op = (object) ['valores' => $colores];

		$opciones = [];
		$personalizables = DB::table('personalizables')->pluck("tablas");
		foreach ($personalizables as $p){
			$op = new Opcion;
			$op->nombre=$p;
			$op->valores =  DB::table($p)->pluck("valor");
			$opciones[] = $op;
		}
	    return compact("opciones",$opciones);
	}
}

class Opcion
{
	public $nombre;
	public $valores;
}