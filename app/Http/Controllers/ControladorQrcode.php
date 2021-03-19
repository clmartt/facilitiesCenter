<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posicao;
use App\Reserva;
use App\Usuario;



class ControladorQrcode extends Controller
{
    public function index(Request $request){
            $data = date("Y-m-d");
           $idemp =
            $posicao = Posicao::where('empresa_idempresa',$request->emp)->where('nome_posicao',$request->pos)->get();
            
            foreach ($posicao as $p) {
                $liberado =  $p['liberada'];
                $pos = $p['nome_posicao'];
                $idempresa = $p['empresa_idempresa'];
            }
            switch ($liberado) {
                case 'sim':
                    return redirect()->route('confirmar',['posicao'=>$pos,'idempresa'=>$idempresa]);
                    break;
                case 'nao':
                    return redirect()->route('apiBloqueada');
                    break;
                
            
            }
      
    }


    public function bloqueada(){
        return view('qrcode.bloqueada');
    }





    public function confirmar($posicao,$idempresa){
    
       
        $data = date('Y-m-d');
        $reserva = Reserva::where('data_reserva',$data)->where('empresa_idempresa',$idempresa)->where('nome_posicao',$posicao)->get();
        $UserOcupante ='';
       
        foreach ($reserva as $res) {
            $UserOcupante = $res->usuario->nome_usuario;
            
        }
        // se nao houver ocupante a posição esta livre para agendamento
        if($UserOcupante == ''){
            return redirect()->route('qrlogin',['posicao'=>$posicao,'idempresa'=>$idempresa]);
        }else{
            return redirect()->route('evoce',['posicao'=>$posicao,'idempresa'=>$idempresa,'ocupante'=>$UserOcupante]);
        }
      
    }



    public function qrlogin($posicao,$idempresa){
        return view('qrcode.qrlogin')->with('posicao',$posicao)->with('idempresa',$idempresa);
    }



    public function evoce($posicao,$idempresa,$ocupante){
        return view('qrcode.evoce')->with('posicao',$posicao)->with('idempresa',$idempresa)->with('ocupante',$ocupante);
    }


    public function checado(Request $request){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
               
         
               // pega o id do usuario da tabela reserva pelo nome da posição
            $idUser = Reserva::select('usuario_idusuario')->where('nome_posicao',$request->posicao)
            ->where('empresa_idempresa',$request->idempresa)
            ->where('data_reserva',$data)->get();
            
            $idUsuarioDaReserva = $idUser[0]['usuario_idusuario'];


            // vai contar se o usuario que tentou realizar o checkin existe como usuario cadastrado
            $userCheckQtd  = Usuario::select('idusuario')->where('email',$request->email)
            ->where('empresa_idempresa',$request->idempresa)
            ->where('senha',$request->senha)->count();

            if($userCheckQtd>0){ // se ele existir

                $userCheckID  = Usuario::select('idusuario')->where('email',$request->email)
                ->where('empresa_idempresa',$request->idempresa)
                ->where('senha',$request->senha)->get();
                $guardaUserCheckId = $userCheckID[0]['idusuario']; 


            }else{ // se nao existir
                return view('qrcode.evoce')->with("error","1")
                ->with('posicao',$request->posicao)
                ->with('idempresa',$request->idempresa)
                ->with('ocupante', $request->email);
            }

// agora compara se o usuario da reserva é o mesmo usuario que tento fazer o login

                if($idUsuarioDaReserva == $guardaUserCheckId){
                    $reserva = Reserva::where('nome_posicao',$request->posicao)
                    ->where('empresa_idempresa',$request->idempresa)
                    ->where('data_reserva',$data)
                    ->update(['checado'=>'sim','hora_check'=>date('H:i:s')]);

                    return view("qrcode.checkin");

                }else{
                    return view('qrcode.evoce')->with("error","1")->with('posicao',$request->posicao)->with('idempresa',$request->idempresa)->with('ocupante', $request->email);
                }
                  

        

            
   
       /*
       $user  = Usuario::where('email',$request->email)
       ->where('empresa_idempresa',$request->idempresa)
       ->where('senha',$request->senha)->count();


       date_default_timezone_set('America/Sao_Paulo');
       $data = date('Y-m-d');
       
        
       if($user > 0){
           $reserva = Reserva::where('nome_posicao',$request->posicao)
           ->where('empresa_idempresa',$request->idempresa)
           ->where('data_reserva',$data)
           ->update(['checado'=>'sim','hora_check'=>date('H:i:s')]);

           return view("qrcode.checkin");

       }else{
          
         return view('qrcode.evoce')->with("error","1")->with('posicao',$request->posicao)->with('idempresa',$request->idempresa)->with('ocupante', $request->email);
       }
      */

    }

    // quando a posição esta livre para reservar 
    public function qrreserva(Request $request){

        // data hoje
        $data = date("Y-m-d");

        // verifica se o usuario existe com os dados de email e senha
        $user  = Usuario::where('email',$request->email)
        ->where('empresa_idempresa',$request->idempresa)
        ->where('senha',$request->senha)->count();
       
        if($user > 0){
            // pega o id do usuario
            $idusuario  = Usuario::select('idusuario')->where('email',$request->email)
            ->where('empresa_idempresa',$request->idempresa)
            ->where('senha',$request->senha)->get();

            foreach ($idusuario as $id) {
                //guarda o id do usuario na variavel
                $idUser = $id['idusuario'];
            }

            

            // pega os dados da posição 
            $posicao  = Posicao::where('nome_posicao',$request->posicao)
            ->where('empresa_idempresa',$request->idempresa)->get();


            // verifica se o usuario ja possui posição agendada para o dia
            $reservaHoje =  Reserva::where('data_reserva',$data)
            ->where('empresa_idempresa',$request->idempresa)->where('usuario_idusuario',$idUser)->count();
            
            if($reservaHoje == 0 ){
                     $reserva = new Reserva();
                    foreach ($posicao as $p) {
                        $reserva->posicoes_idposicoes = $p['idposicoes'];
                        $reserva->usuario_idusuario = $idUser;
                        $reserva->empresa_idempresa = $request->idempresa;
                        $reserva->data_reserva  = date("Y-m-d");
                        $reserva->hora_reserva = date("h:i:s");
                        $reserva->nome_posicao = $request->posicao;
                        $reserva->andar = $p['andar'];
                        $reserva->area= $p['area'];
                        $reserva->gerente = $p['gerente'];
                        $reserva->diretoria = $p['diretoria'];
                        $reserva->checado = 'sim';
                        $reserva->hora_check = date("h:i:s");
                        $reserva->hora_inicio = date("h:i:s");
                        $reserva->hora_fim = date("h:i:s");
                        $reserva->tipo = "";
                        $reserva->hashreserva = "";

                        $reserva->save();   
                        return view('qrcode.qrreservada');
                        }
            }else{
                $reservaUser =  Reserva::where('data_reserva',$data)
                ->where('empresa_idempresa',$request->idempresa)->where('usuario_idusuario',$idUser)->get();
                foreach ($reservaUser as $r) {
                    $pos = $r['nome_posicao'];
                    $diaReserva = $r['data_reserva'];
                    
                }
                return view("qrcode.negar")->with("data",$diaReserva)->with("posicao",$pos);
            }
           


 
        }else{

            return view('qrcode.qrlogin')->with('posicao',$request->posicao)->with('idempresa',$request->idempresa)->with('error','Ops! Algo errado nas informações');
        }


    }




}
