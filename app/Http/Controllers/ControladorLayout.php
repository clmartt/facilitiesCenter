<?php

namespace App\Http\Controllers;
use App\Reserva;
use App\Posicao;
use Illuminate\Http\Request;

class ControladorLayout extends Controller
{
    public function kvmterreo(Request $request)
    {
        if($request->dia){
            $data = $request->dia;
        }else{
            $data = date('Y-m-d');
        }


        $bloqueada = Posicao::where('liberada','nao')->get(); // pega todas as posições bloqueadas
        $bloqueadas = Array();
        foreach ($bloqueada as $b) {
            array_push($bloqueadas,$b['nome_posicao']);
        }
        $posicoesBloqueadas = implode("|",$bloqueadas);


        $reservadas = Reserva::where('data_reserva',$data)->get(); // pega as reservas pela data 
        $arrayPosicao = array(); // array paga guardar as posições reservadas
        foreach ($reservadas as $res) {
            array_push( $arrayPosicao,$res['nome_posicao']);
        }
        $todosNomes = implode("|",$arrayPosicao);
        return view('andar.kvmterreo')->with('arrayPosicao',$todosNomes)->with('dia',$data)->with('bloqueadas',$posicoesBloqueadas);
    }



    public function kvmp01(Request $request)
    {
        if($request->dia){
            $data = $request->dia;
        }else{
            $data = date('Y-m-d');
        }

        $bloqueada = Posicao::where('liberada','nao')->get(); // pega todas as posições bloqueadas
        $bloqueadas = Array();
        foreach ($bloqueada as $b) {
            array_push($bloqueadas,$b['nome_posicao']);
        }
        $posicoesBloqueadas = implode("|",$bloqueadas);



        
        $reservadas = Reserva::where('data_reserva',$data)->get();
        $arrayPosicao = array();
        foreach ($reservadas as $res) {
            array_push( $arrayPosicao,$res['nome_posicao']);
        }
        $todosNomes = implode("|",$arrayPosicao);
        return view('andar.kvmp01')->with('arrayPosicao',$todosNomes)->with('dia',$data)->with('bloqueadas',$posicoesBloqueadas);
        
        
        
        
        
        
    }




    public function kvmsub()
    {
        return view('andar.kvmsub');
    }
}
