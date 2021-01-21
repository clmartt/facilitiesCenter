<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VagaReserva;
use App\Convite;
use PhpParser\Node\Stmt\Break_;

class ControladorCancelaVaga extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function destroy($id,$layout)
    {
        
        
        $dadosReserva = VagaReserva::select('data_reserva','email','id_empresa')->where('id',$id)->get();
        
      
        foreach ($dadosReserva as $dados) {
            $dataReserva = $dados['data_reserva'];
            $emailReserva = $dados['email'];
            $idEmpresaReserva = $dados['id_empresa'];
            echo $dados['data_reserva'];
        }
       
        $upVagaConvite = Convite::where('data',$dataReserva)->where('email',$emailReserva)->where('id_empresa',$idEmpresaReserva)
        ->update(['vaga'=>0]);
        $reserva = VagaReserva::where('id',$id)->delete();
        
        switch($layout){

            case "minhasreservas":
                return redirect()->route($layout);
                break;
            case "garagem":
                return redirect()->route("garagem");
                break;
            default :
                return redirect()->route("reservas");

        }


       
    }
}
