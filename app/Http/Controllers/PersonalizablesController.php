<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personalizables;

class PersonalizablesController extends Controller
{
	public function json(){
		return Personalizables::p();
	}
}
