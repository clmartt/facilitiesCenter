<?php

namespace App\Http\Controllers;

use App\Grupo;
use App\Reserva;
use App\Posicao;
use Illuminate\Http\Request;

class ControladorLayout extends Controller
{
    public function Andar12(Request $request)
    {
        $idEmpresa = session()->get('idempresa');
        $grupos = Grupo::select('id_grupo','nome_grupo','cor')
        ->where('id_empresa',$idEmpresa)
        ->where('nome_grupo','!=','Sem Grupo')
        ->groupBy('id_grupo','nome_grupo','cor')->get();
        if($request->dia){
            $data = $request->dia;
        }else{
            $data = date('Y-m-d');
        }

        $allPosicao = Posicao::where('empresa_idempresa',$idEmpresa)->where('andar','TERREO')->get();

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
        return view('andar.kvmterreo')->with('arrayPosicao',$todosNomes)->with('dia',$data)->with('bloqueadas',$posicoesBloqueadas)
        ->with('allPosicao',$allPosicao)
        ->with('grupos',$grupos);
    }



    public function kvmp01(Request $request)
    {
        $idEmpresa = session()->get('idempresa');
        $grupos = Grupo::select('id_grupo','nome_grupo','cor')->where('id_empresa',$idEmpresa)->groupBy('id_grupo','nome_grupo','cor')->get();
        if($request->dia){
            $data = $request->dia;
        }else{
            $data = date('Y-m-d');
        }
        $allPosicao = Posicao::where('empresa_idempresa',$idEmpresa)->where('andar','P1')->get();
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
        return view('andar.kvmp01')->with('arrayPosicao',$todosNomes)->with('dia',$data)
        ->with('allPosicao',$allPosicao)
        ->with('grupos',$grupos)
        ->with('bloqueadas',$posicoesBloqueadas);
        
        
        
        
        
        
    }




    public function kvmsub()
    {
        return view('andar.kvmsub');
    }
}
