<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VagaReserva;
use App\Vaga;
use App\Reserva;
class ControladorVaga extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idusuario = session()->get('idusuario');
        $idempresa = session()->get('idempresa');
        
        if($request->dia){
            $dia = $request->dia;
            $reservas = VagaReserva::where('id_empresa',$idempresa)->where('data_reserva',$request->dia)->get();
        }else{
            $dia = date('Y-m-d');
            $reservas = VagaReserva::where('id_empresa',$idempresa)->where('data_reserva',$dia)->get();
        }
        return view('estacionamento.garagem')->with('dia',$dia)->with('reservas',$reservas);
    }






    public function qtdvaga(Request $request)
    {   
         $idempresa = session()->get('idempresa');
        if($request->dia){
            $data = $request->dia;
             $qtdOcupada = VagaReserva::where('id_empresa',$idempresa)->where("data_reserva",$data)->count();
        }else{
            $data = date('Y-m-d');
            $qtdOcupada = VagaReserva::where('id_empresa',$idempresa)->where("data_reserva",$data)->count();
        }

              
        $qtd = Vaga::select('qtd_vagas')->where('id_empresa',$idempresa)->get();
        foreach($qtd as $q){
            $quantidade = $q['qtd_vagas'];
            
        }
        $qtddisponivel = $quantidade  - $qtdOcupada;
       
        return view('estacionamento.qtdvaga')->with('qtd',$quantidade)->with('ocupada',$qtdOcupada)->with('disponivel',$qtddisponivel)->with('dia',$data);
    }

 




    public function create()
    {
        //
    }

    



    public function store(Request $request)
    {   
        
        //contando quantas reservas o usuario tem com a mesma data
        $idusuario = session()->get('idusuario');
        $idempresa = session()->get('idempresa');
        $count = VagaReserva::where('data_reserva',$request->dataReserva)->where('id_usuario',$idusuario)->where('id_empresa',$idempresa)->count();
        $posicao = Reserva::where('usuario_idusuario',$idusuario)->where('empresa_idempresa',$idempresa)->where('data_reserva',$request->dataReserva)->count();
            if($count==0){
                $salvarVaga = new VagaReserva();
                $salvarVaga->data_reserva = $request->dataReserva;
                $salvarVaga->id_empresa = session()->get('idempresa');
                $salvarVaga->colaborador = session()->get('nome');
                $salvarVaga->email = session()->get('email');
                $salvarVaga->id_usuario = session()->get('idusuario');
                $salvarVaga->placa = $request->placa;
                $salvarVaga->save();
                return view('estacionamento.reservavaga')->with('ok','Vaga Reservada')->with('posicao',$posicao);
            }else{
                return view('estacionamento.reservavaga')->with('error','Você já possui Vaga Reservada para o dia '.date('d-m-Y',strtotime( $request->dataReserva)))
                ->with('posicao',$posicao);
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


    public function qtdUp(Request $request){
        $idempresa = session()->get('idempresa');
        $up = Vaga::where('id_empresa',$idempresa)->update(["qtd_vagas"=>$request->qtd]);
        return redirect()->route('qtdvaga');

;
    }
    
}
