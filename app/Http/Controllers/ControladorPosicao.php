<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posicao;
use App\Reserva;
use App\VagaReserva;

class ControladorPosicao extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->dia){
            $data = $request->dia;
        }else{
            $data = date('Y-m-d');
        }
        // pega a quantidade de posições
        $posicaoTerreo = Posicao::where('andar','TERREO')->count();
        $posicaoP1 = Posicao::where('andar','P1')->count();
        $posicaoSub = Posicao::where('andar','SUB')->count();

        // pega a quantidade de Bloqueadas
        $posicaoTerreoBloqueada = Posicao::where('andar','TERREO')->where('liberada','!=','sim')->count();
        $posicaoP1Bloqueada = Posicao::where('andar','P1')->where('liberada','!=','sim')->count();
        $posicaoSubBloqueada = Posicao::where('andar','SUB')->where('liberada','!=','sim')->count();

         
        // pega a quantidade de reservas
        $reservasTerreo = Reserva::where('data_reserva',$data)->where('andar','TERREO')->count();
        $reservasP1 = Reserva::where('data_reserva',$data)->where('andar','P1')->count();
        $reservasSub = Reserva::where('data_reserva',$data)->where('andar','SUB')->count();

        //pega a quantidade de checados ou seja ocupadas.
        $reservasCheckTerreo = Reserva::where('data_reserva',$data)->where('andar','TERREO')->where('checado','sim')->count();
        $reservasCheckP1 = Reserva::where('data_reserva',$data)->where('andar','P1')->where('checado','sim')->count();
        $reservasCheckSub = Reserva::where('data_reserva',$data)->where('andar','SUB')->where('checado','sim')->count();
        
        return view('posicoes')
        ->with('reservasTerreo',$reservasTerreo)
        ->with('reservasP1',$reservasP1)
        ->with('reservasSub',$reservasSub)
        ->with('qtdPosicaoTerreo',$posicaoTerreo)
        ->with('qtdPosicaoP1',$posicaoP1)
        ->with('dia',$data)
        ->with('reservasCheckTerreo',$reservasCheckTerreo)
        ->with('reservasCheckP1',$reservasCheckP1)
        ->with('reservasCheckSub',$reservasCheckSub)
        ->with('qtdPosicaoSub',$posicaoSub)
        ->with('posicaoTerreoBloqueada',$posicaoTerreoBloqueada)
        ->with('posicaoP1Bloqueada',$posicaoP1Bloqueada)
        ->with('posicaoSubBloqueada',$posicaoSubBloqueada);

        
    }

    public function bloqueada(){
        $idEmpresa = session()->get('idempresa');
        $bloqueadas = Posicao::where("liberada","nao")->where('empresa_idempresa',$idEmpresa)->get();

        return view('bloqueadas')->with("bloqueadas",$bloqueadas);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $nomeposicao =  $request->nomePosicao;
        $idusuario = session()->get('idusuario');
        $idempresa = session()->get('idempresa');
        $posicao = Posicao::where('nome_posicao',$nomeposicao)->where('empresa_idempresa',$idempresa)->get();
        $diaReserva = $request->dia;
        $contReserva = Reserva::where('usuario_idusuario', $idusuario)->where('data_reserva',$diaReserva)->count();
        $estacionamento = VagaReserva::where('id_empresa',$idempresa)->where('id_usuario',$idusuario)->where('data_reserva',$request->dia)->count();

        
      
        if($contReserva>=1){
            return view('confirm.confirm')->with('negado',"negado")->with('dia',$diaReserva);
        }
        $reserva = new Reserva();
        foreach ($posicao as $res) {
            $reserva->posicoes_idposicoes = $res['idposicoes'];
            $reserva->usuario_idusuario =  $idusuario ;
            $reserva->empresa_idempresa = $idempresa;
            $reserva->data_reserva = $request->dia;
            $reserva->nome_posicao = $res['nome_posicao'];
            $reserva->andar = $res['andar'];
            $reserva->hora_reserva = date("H:i:s");
            $reserva->area = $res['area'];
            $reserva->gerente = $res['gerente'];
            $reserva->diretoria = $res['diretoria'];
            $reserva->checado = "nao";
            $reserva->hora_check = "00:00:00";
            $reserva->hora_inicio = "00:00:00";
            $reserva->hora_fim = "00:00:00";
            $reserva->tipo = $res['tipo'];
            $reserva->hashreserva = hash('md5',date('H:i:s'));
           
            $reserva->save();
            //return view('confirm.confirm')->with('nomePosicao',$nomeposicao)->with('dia',$diaReserva)->with("count",$contReserva)->with('estacionamento',$estacionamento);
              return redirect()->back();          
            
        }
     


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function bloquear(Request $request)
    {
        $id = Posicao::where('nome_posicao',$request->getPosicao)
        ->update(['liberada'=>"nao",'finalidade'=>$request->finalidade,'bloqueio_para'=>$request->email_user,'motivo_block'=>$request->motivo_block]);
        $dadosPosicao = Posicao::where('nome_posicao',$request->getPosicao)->get();
        foreach ($dadosPosicao as $p) {
            $nome = $p['nome_posicao'];
        }
        $dia = date("d-m-Y");
        //return view("confirm.confirmblock")->with("nomePosicao",$nome)->with("dia",$dia);
        return redirect()->back();

    }

    public function definirGrupo(Request $request){
        $idEmpresa = session()->get('idempresa');
        $getPosicaoGrupo = $request->getPosicaoGrupo;//[0] id grupo ----[1]nome grupo ----[2]cor do grupo 
        $selectGrupo = explode('|',$request->selectGrupo);

        if($request->selectGrupo =='vaga'){
            $up = Posicao::where('nome_posicao',$getPosicaoGrupo)->where('empresa_idempresa',$idEmpresa)
            ->update(['id_grupo'=>0,'cor_grupo'=>"",'nome_grupo'=>""]);
        }else{
            $up = Posicao::where('nome_posicao',$getPosicaoGrupo)->where('empresa_idempresa',$idEmpresa)
            ->update(['id_grupo'=>$selectGrupo[0],'cor_grupo'=>$selectGrupo[2],'nome_grupo'=>$selectGrupo[1]]);
        }
        
      

        return redirect()->back();

        


    }


}
