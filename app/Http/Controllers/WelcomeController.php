<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(Request $request) {
      $idURL = $request->input("idURL");
      return view('welcome', ['idURL' => $idURL]);
    }
}
