<?php

namespace App\Http\Controllers;
use App\CentroCusto;
use App\Usuario;

use Illuminate\Http\Request;

class ControladorCentroCusto extends Controller
{
    //

    public function formNovoCentroCusto(){
        return view('centroCusto.novoCentroCusto');
    }

    public function salvaNovoCentroCusto(Request $request){
        $idEmpresa = session()->get('idempresa');
        $regras=[
            'centroCusto'=> 'required|unique:centro_custo'
        ];
        $mensagens=[
            'centroCusto.unique'=>'Centro de Custo já está cadastrado!',
        ];
        $request->validate($regras,$mensagens);
            
       


        $salvar = new CentroCusto();
        $salvar->id_empresa = $idEmpresa;
        $salvar->nome_centro = $request->novoCC;
        $salvar->centroCusto = $request->centroCusto;
        $salvar->area = $request->novoCCArea;
        $salvar->gestor = $request->novoCCGestor;
        $salvar->diretor = $request->novoCCDiretor;
       
        $salvar->save();
        return redirect()->back()->with(['salvo'=>'Informações Salvas com Sucesso!!!']);
    }


        public function listaCentroCusto(){
            $idEmpresa = session()->get('idempresa');
            $cc = CentroCusto::where('id_empresa',$idEmpresa)->where('deleted_at', null)->orderBy('area')->get();

            return view('centroCusto.listaCentroCusto')->with('cc',$cc);

        }

        public function editCentroCusto(Request $request){
            $idEmpresa = session()->get('idempresa');
            $centro = CentroCusto::where('id',$request->idCC)->where('id_empresa',$idEmpresa)->get();
            return view('centroCusto.editCentroCusto')->with('cc',$centro);
        }

        public function atualizaCentroCusto(Request $request){
            $idEmpresa = session()->get('idempresa');
            $centro = CentroCusto::where('id',$request->idCC)->where('id_empresa',$idEmpresa)
            ->update([
               'nome_centro' => $request->novoCC, 
               'centroCusto' => $request->centroCusto, 
               'area' => $request->novoCCArea, 
               'gestor' => $request->novoCCGestor, 
               'diretor' => $request->novoCCDiretor
            ]);

            return redirect()->back()->with('ok','Informações Atualizadas!');
        }

        public function deleteCentroCusto(Request $request){
            $idEmpresa = session()->get('idempresa');
            $diaHoje = date('Y-m-d');
            $usuario = Usuario::where('empresa_idempresa',$idEmpresa)->where('id_centroCusto',$request->idCentroCustoExcluir)
            ->update([
                'id_centroCusto' => null,
                'centroCusto' => null
            ]);
            $centro = CentroCusto::where('id',$request->idCentroCustoExcluir)->where('id_empresa',$idEmpresa)
            ->update([
               'deleted_at' => $diaHoje, 
             
            ]);

            return redirect()->back();

        }


}
