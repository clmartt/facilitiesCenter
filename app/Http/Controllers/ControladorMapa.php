<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorMapa extends Controller
{
    public function index(){
        return view('maps.maps');
    }
}
