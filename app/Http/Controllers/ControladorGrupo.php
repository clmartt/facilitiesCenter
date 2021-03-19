<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\Posicao;
use App\Usuario;

class ControladorGrupo extends Controller
{

    public function formGrupo(){
        $idEmpresa = session()->get('idempresa');
        $grupos = Grupo::where('id_empresa',$idEmpresa)->get();
        return view('form.grupo')->with('grupos',$grupos);

    }




    public function salvaGrupo(Request $request){
       
        
        $idEmpresa = session()->get('idempresa');
        $nomeGrupo = $request->nomeGrupo;
        $corGrupo = $request->corGrupo;
        $add = new Grupo();
        $add->id_empresa = $idEmpresa;
        $add->nome_grupo = $nomeGrupo;
        $add->cor = $corGrupo;
        $add->ativo = "sim";
        
        $ok = '1';
        $erro = '0';

        if($add->save()){
            return view('form.grupo')->with('retorno',$ok);
        }else{
            return view('form.grupo')->with('retorno',$erro);
        }

        
        
    }

    public function listaGrupos(){
        $idEmpresa = session()->get('idempresa');
        $grupos = Grupo::where('id_empresa',$idEmpresa)->where('nome_grupo','!=','Sem Grupo')->get();
        return view('grupo.listagrupo')->with('grupos',$grupos);
    }

    public function salvaEditarGrupo(Request $request){
        //dd($request->all());
        $idEmpresa = session()->get('idempresa');
        $idGrupo = $request->txtIdGrupo;
        $novoNomeGrupo = $request->novoNomeGrupo;
        $novaCor = $request->novaCor;

        $up = Grupo::where('id_empresa',$idEmpresa)->where('id_grupo',$idGrupo)
        ->update([
            'nome_grupo'=>$novoNomeGrupo,
            'cor' => $novaCor
        ]);

        $upPosicao = Posicao::where('empresa_idempresa',$idEmpresa)->where('id_grupo',$idGrupo)
        ->update([
            'cor_grupo'=>$novaCor,
            'nome_grupo'=>$novoNomeGrupo
        ]);

        if($up){
            return redirect()->back()->with('status','1');
        }else{
            return redirect()->back()->with('status','0');
        }


    }


    public function deletaGrupo(Request $request){
        $idEmpresa = session()->get('idempresa');
        $semGrupo = Grupo::select('id_grupo')->where('id_empresa',$idEmpresa)->where('nome_grupo','Sem Grupo')->get();
        $idGrupo = $request->idGrupo;
        // pegar a posição que tem o mesmo id do grupo para update e faz update na posição 
        $upPosicao = Posicao::where('empresa_idempresa',$idEmpresa)->where('id_grupo',$idGrupo)
        ->update([
            'cor_grupo'=>"",
            'nome_grupo'=>""
        ]);

            // vai na tabela usuario e torna ele um usuario sem grupo
            $upUsuario = Usuario::where('empresa_idempresa',$idEmpresa)->where('id_grupo',$idGrupo)
            ->update(['id_grupo'=>$semGrupo[0]['id_grupo']]);


                // vai na tabela grupo e deleta o grupo
        $up = Grupo::where('id_empresa',$idEmpresa)->where('id_grupo',$idGrupo)
        ->delete();
        
            

    }
}
