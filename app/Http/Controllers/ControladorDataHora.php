<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use App\TimeZones\TimeZones;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class ControladorDataHora extends Controller
{
    public function enviaDataHora($sala,$horaInicio,$horaFim){
       
        return view('newevent')->with('sala',$sala)->with('horaInicio',$horaInicio)->with('horaFim',$horaFim);
    }
}
