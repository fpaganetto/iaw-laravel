<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Redirect;

class ABMController extends Controller{
    public function eliminarCategoria(){
    	$nombre = Request::get('eliminar');
		
		DB::table("personalizables")->where('tablas', '=', $nombre)->delete();
		Schema::dropIfExists($nombre);

		return Redirect::to('admin');
    }

    public function eliminarElemento(){

    	$categoria = Request::get('categoria');
    	$nombre = Request::get('eliminar');
		
		DB::table($categoria)->where('valor', '=', $nombre)->delete();

		return Redirect::to('admin');
    }

    public function crearCategoria(){
    	try{
	    	//$input = Request::all();
	    	$nombre = Request::get('nombre');
	    	
	    	DB::table('personalizables')->insert(['tablas' => $nombre]);

	    	//Se crea la tabla donde se guardan dichos elementos
	        Schema::connection('mysql')->create($nombre, function($table)
			{
			    $table->string('valor');
			});

	        //Vuelve a la pagina de admin
	    	return Redirect::to('admin');
	    
	    }catch(\Illuminate\Database\QueryException $e){
	    	//Caso en que por ejemplo exista la tabla o la categoria declarada en la tabla de personalizables
	    	return Redirect::to('admin');
	    }
    }
}
