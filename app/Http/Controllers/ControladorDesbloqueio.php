<?php

namespace App\Http\Controllers;
use App\Posicao;
use Illuminate\Http\Request;

class ControladorDesbloqueio extends Controller
{
    public function desbloquear(Request $request)
    {
        $idEmpresa = session()->get('idempresa');
        $unlock = Posicao::where("nome_posicao",$request->posicao)->where('empresa_idempresa',$idEmpresa)
        ->update(['liberada'=>'sim','finalidade'=>null,'bloqueio_para'=>null,'motivo_block'=>null]);
        $bloqueadas = Posicao::where("liberada","nao")->where('empresa_idempresa',$idEmpresa)->get();

        if($unlock){
            return view('bloqueadas')->with('bloqueadas',$bloqueadas);
        }else{
            return "Ops! Algo errado com o Desbloqueio ";
        }
    }
        
}
