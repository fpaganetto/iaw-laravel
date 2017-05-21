<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class RecordarController extends Controller
{
    public function recordar() {
      if (Auth::check()) {
        return Auth::id(); //retornamos el id de usuario para distinguir si el javascript lo registra en la base de datos o con una cookie
      }
      else {
        return "";
      }
    }

    public function cargarUsuario(Request $request) {
      if ($request->has("idUser")) {
        $idUser = $request->input("idUser");
        $idURL = DB::table('compartir')->select('idURL')->where('idUser', '=', $idUser)->get();
        return $idURL;
      }
      else {
        return "";
      }
    }

    public function olvidarUsuario(Request $request) {
      if ($request->has("idUser")) {
        $idUser = $request->input("idUser");
        DB::table('compartir')->where('idUser', '=', $idUser)->delete();
      }
      else {
        return "";
      }
    }
}
