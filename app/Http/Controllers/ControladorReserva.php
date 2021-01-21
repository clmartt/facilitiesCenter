<?php

namespace App\Http\Controllers;
use App\Reserva;
use Illuminate\Http\Request;
use App\ReservaSala;
use App\VagaReserva;
use Illuminate\Support\Facades\URL;

class ControladorReserva extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
          // mostra as reservas de posições do colaborador
        $idusuario = session()->get('idusuario');
        if($request->dia){
            $data = $request->dia;
            $minhasReservas = Reserva::where('usuario_idusuario', $idusuario)->where('data_reserva',$data)->orderBy('data_reserva')->get();
            $minhasSalas = ReservaSala::where('id_user', $idusuario)->where('data_inicio','>=',$data)->orderBy('hora_inicio')->get();
            $minhasVagas = VagaReserva::where('id_usuario', $idusuario)->where('data_reserva',$data)->orderBy('data_reserva')->get();
        }else{
            $data = date('Y-m-d');
            $minhasReservas = Reserva::where('usuario_idusuario', $idusuario)->where('data_reserva','>=',$data)->orderBy('data_reserva')->get();
            $minhasSalas = ReservaSala::where('id_user', $idusuario)->where('data_inicio','>=',$data)->orderBy('hora_inicio')->get();
            $minhasVagas = VagaReserva::where('id_usuario', $idusuario)->where('data_reserva','>=',$data)->orderBy('data_reserva')->get();
        }
           
        $end = URL::current();
        $layout = explode("/",$end);
        $layoutView =end($layout);
        return view('reservas')
        ->with('minhasReservas',$minhasReservas)
        ->with('minhasSalas',$minhasSalas)
        ->with('minhasVagas',$minhasVagas)
        ->with('layout',$layoutView)
        ->with('dia',$data);
        
        
    }

    







    public function garagemreserva(Request $request){
        // mostra as reservas de posições do colaborador
        $idusuario = session()->get('idusuario');
        if($request->dia){
            $data = $request->dia;
            $minhasReservas = Reserva::where('usuario_idusuario', $idusuario)->where('data_reserva',$data)->orderBy('data_reserva')->get();
            $minhasSalas = ReservaSala::where('id_user', $idusuario)->where('data_inicio','>=',$data)->orderBy('hora_inicio')->get();
            $minhasVagas = VagaReserva::where('id_usuario', $idusuario)->where('data_reserva',$data)->orderBy('data_reserva')->get();
        }else{
            $data = date('Y-m-d');
            $minhasReservas = Reserva::where('usuario_idusuario', $idusuario)->where('data_reserva','>=',$data)->orderBy('data_reserva')->get();
            $minhasSalas = ReservaSala::where('id_user', $idusuario)->where('data_inicio','>=',$data)->orderBy('hora_inicio')->get();
            $minhasVagas = VagaReserva::where('id_usuario', $idusuario)->where('data_reserva','>=',$data)->orderBy('data_reserva')->get();
        }
           
        $end = URL::current();
        $layout = explode("/",$end);
        $layoutView =end($layout);

        
        
        return view('estacionamento.minhasreservas')
        ->with('minhasReservas',$minhasReservas)
        ->with('minhasSalas',$minhasSalas)
        ->with('minhasVagas',$minhasVagas)
        ->with('layout',$layoutView)
        ->with('dia',$data);
        
        
    }



    public function create(Request $request)
    {
        return view('estacionamento.reservavaga')->with('dia',$request->dia);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
