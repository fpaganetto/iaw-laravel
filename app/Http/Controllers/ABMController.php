<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage as Storage;
use Illuminate\Support\Facades\Input as Input;
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

    public function categoriaVista($categoria){
    	return view('admin/crearElemento', ['categoria' => $categoria]);
    }

    public function crearElemento(){
    	//if(Input::hasFile('file')){ XXX
    		$file_content = Request::get('file');
    		$categoria = Request::get('categoria');
    		$nombreNuevo = Request::get('nombre');

    		//Guarda el archivo
    		Storage::disk('app')->put($nombreNuevo.".png", $file_content);

    		//Agrega en la bd el elemento nuevo
    		DB::table($categoria)->insert(['valor' => $nombreNuevo]);
    	//}
    	//else dd("No hay archivo");

    	return Redirect::to('admin');
    }

    /**
     XXX Falta renombrar el archivo
    */
    public function editarElemento(){
        $categoria = Request::get('categoria');
        $nombreViejo = Request::get('nombreViejo');
        $nombreNuevo = Request::get('nombreNuevo');
        DB::table($categoria)->where('valor', $nombreViejo)->update(['valor' => $nombreNuevo]);

        //XXX
        //Storage::move('/public/app/img/'.$categoria.'/'.$nombreViejo.'.png', '/public/app/img/'.$categoria.'/'.$nombreNuevo.'.png');

        return Redirect::to('admin');
    }

    /**
     XXX Falta renombrar el directorio
    */
    public function editarCategoria(){
        $categoriaViejo = Request::get('categoriaViejo');
        $categoriaNuevo = Request::get('categoriaNuevo');
        
        DB::table("personalizables")->where('tablas', $categoriaViejo)->update(['tablas' => $categoriaNuevo]);
        Schema::rename($categoriaViejo, $categoriaNuevo);

        return Redirect::to('admin');
    }
}
