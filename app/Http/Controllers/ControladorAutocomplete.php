<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visitante;

class ControladorAutocomplete extends Controller
{
   public function index(){
       return view("visitante.convite");
   }

   public function fetch(Request $request){
        if($request->get('query')){
            $query = $request->get('query');
            $dados = Visitante::select('nome','email')->where('nome','LIKE','%'.$query.'%')->orWhere('email','LIKE','%'.$query.'%')->get();
            $output = '<ul  style="display:block ; position:relative">';
            foreach ($dados as $row) {
                $output .= '<li><a href="#">'.$row->nome." | ". $row->email.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }


   }
}
