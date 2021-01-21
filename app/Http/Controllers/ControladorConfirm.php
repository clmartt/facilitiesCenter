<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorConfirm extends Controller
{
    public function index(Request $request)
    {   $dia = $request->dia;
        return view('confirm.confirm')->with('dia',$dia);
    }
}
