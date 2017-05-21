<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CompartirController extends Controller {

    public function registrar(Request $request) {
      //strData es el json con todas las propiedades
      if ($request->has("strData")) {
        $str_json = $request->input("strData");
        $decoded = json_decode($str_json); //arreglo con datos del json
        $idURL = $decoded->idURL;
        $idUser = $decoded->idUser;
        $insertar = true;

        if ($idUser != "") {
          $existente = DB::table('compartir')->select('json')->where('idUser', '=', $idUser)->get();
          if (!$existente->isEmpty()) {
            //como ya existe actualizamos sólo la columna json
            DB::table('compartir')
            ->where('idUser', $idUser)
            ->update(['json' => $str_json]);
            $insertar = false;
          }
        }

        if ($insertar) {
          DB::table('compartir')->insert(
            ['idURL' => $idURL, 'json' => $str_json, 'idUser' => $idUser]
          );
        }
      }
    }


    public function obtenerJSON(Request $request) {
      //request trae el idURL para acceder a la base de datos

      if ($request->has("idURL")) {
        $idURL = $request->input("idURL");

        $json = DB::table('compartir')->select('json')->where('idURL', '=', $idURL)->get();

        //$json->json; //el atributo json de la entrada en la tabla de la base de datos (osea, el json del auto)

        return $json;
      }
    }

}
