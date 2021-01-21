<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Illuminate\Http\Request;
use App\TokenStore\TokenCache;
use App\TimeZones\TimeZones;
use Beta\Microsoft\Graph\Model\AddHeader;
use Symfony\Component\CssSelector\Parser\Token;
use Illuminate\Support\Facades\URL;
use App\Visitante;
use App\Convite;
use \App\Vaga;
use \App\VagaReserva;

class ControladorVisitante extends Controller
{

    // -------------------------------------------------------
    private function getGraph(): Graph
    {
      // Get the access token from the cache
      $tokenCache = new TokenCache();
      $accessToken = $tokenCache->getAccessToken();
  
      // Create a Graph client
      $graph = new Graph();
      $graph->setAccessToken($accessToken);
      return $graph;
    }


    public function loadViewData()
    {
        $viewData = [];

        // Check for flash errors
        if (session('error')) {
            $viewData['error'] = session('error');
            $viewData['errorDetail'] = session('errorDetail');
        }

        // Check for logged on user
        if (session('userName'))
        {
            $viewData['userName'] = session('userName');
            $viewData['userEmail'] = session('userEmail');
            $viewData['userTimeZone'] = session('userTimeZone');
        }

        return $viewData;
    }
    




    // -------------------------------------------------------



    public function index(Request $request){
        if($request->dia ==''){
            $data = date('Y-m-d');
        }else{
            $data = $request->dia;
        }
        $idempresa = session()->get('idempresa');
        $idusuario = session()->get('idusuario');
        
                
        $evento = Convite::select('assunto','data',Convite::raw('count(nome_visitante) as qtdV'),Convite::raw('sum(confirmado = "1") as qtdC'),Convite::raw('sum(confirmado = "0") as qtdP'))
        ->where("id_empresa",$idempresa)
        ->where("id_usuario",$idusuario)
        ->where('data',$data)
        ->groupBy('assunto','data')
        ->get();

        
       
       
        
        return view('visitante.home')->with('dia',$data)->with('evento',$evento);
    }


    public function convite(){
        return view('visitante.convite');
    }


    public function salvar(Request $request){

     $consultaemail = Visitante::where('email',$request->email)->count();
     if($consultaemail>0){
         return  1;
     }
     if($request->nome == ""){
        return  2; // nome vazio
     }
     if($request->email == ""){
        return  3; // nome vazio
     }

        $nome = $request->nome;
        $email = $request->email;
        $idempresa = session()->get('idempresa');

        $visita = new Visitante();
        $visita->nome = $nome;
        $visita->email = $email;
        $visita->placa = "000";
        $visita->id_empresa = $idempresa;

        $visita->save();
            
        
       


    }


    
    public function enviaConvite(Request $request)
    {
        
        $part = explode(",",$request->participantes);
        $nome = explode(",",$request->nome_user);
        $idusuario = session()->get('idusuario');
        $idempresa = session()->get('idempresa');
        $graf = $this->getGraph();
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();


        
            for ($i=0; $i < count($part); $i++) { 
                $convite = new Convite();
                $convite->nome_visitante = $nome[$i];
                $convite->email = $part[$i] ;
                $convite->assunto = $request->assunto;
                $convite->data= $request->data;
                $convite->hora_inicio = $request->data;
                $convite->dataT= $request->dataT;
                $convite->horaT = $request->dataT;
                $convite->id_usuario = $idusuario;
                $convite->id_empresa= $idempresa;
                $convite->confirmado= 0;
                $convite->vaga= 0;
                $convite->placa= 'xxx-0000';
                $convite->save();
            };
                       
            //================================================================================================================
            // ENVIO DE CONVITE 
                       $viewData = $this->loadViewData();

                        $graph = $this->getGraph();
                    
                        // Attendees from form are a semi-colon delimited list of
                        // email addresses
                        $attendeeAddresses = explode(',', trim($request->participantes));
                    
                        // The Attendee object in Graph is complex, so build the structure
                        $attendees = [];
                        foreach($attendeeAddresses as $attendeeAddress)
                        {
                            
                        array_push($attendees, [
                            // Add the email address in the emailAddress property
                            'emailAddress' => [
                            'address' => trim($attendeeAddress)
                            ],
                            // Set the attendee type to required
                            'type' => 'required'
                        ]);
                        }
                    
                        // Build the event
                        $newEvent = [
                        'subject' => $request->assunto,
                        'attendees' => $attendees,
                        'start' => [
                            'dateTime' => $request->data,
                            'timeZone' => $viewData['userTimeZone']
                        ],
                        'end' => [
                            'dateTime' => $request->dataT,
                            'timeZone' => $viewData['userTimeZone']
                        ],
                        'body' => [
                            'content' => $request->txtDesc.'<br><a href='.$url = URL::signedRoute("aceite", ["idConvite" => $convite->id]).'>Confirme sua Presença</a>',
                            'contentType' => 'html'
                        ]
                        ];
                    
                        // POST /me/events
                        $response = $graph->createRequest('POST', '/me/events')
                        ->attachBody($newEvent)
                        ->setReturnType(Model\Event::class)
                    
                        
                        ->execute();
        
            //================================================================================================================
            
         
            
                
            return view("visitante.convite")->with("result","Convites Enviados!");
           
          
    }

    public function aceite(Request $request){

        $idempresa = session()->get('idempresa');
        $convite = Convite::where('id',$request->idConvite)->get();
        $confirmado= Convite::where('id',$request->idConvite)->update(['confirmado'=>1]);
        $vaga = Convite::select('vaga')->where('id',$request->idConvite)->get();
       
        return view('visitante.aceite')->with('idConvite',$convite)->with('vaga',$vaga[0]['vaga']);
       
    }
        

    public function evento(Request $request){
        if($request->dia == ''){
            $dia = date("Y-m-d");
        }else{
            $dia = $request->dia;
        }
        $idusuario = session()->get('idusuario');
        $idempresa = session()->get('idempresa');
        $convites = Convite::select('id','assunto','data','hora_inicio')->where('id_usuario',$idusuario)->where('id_empresa',$idempresa)->groupBy('assunto','id','data','hora_inicio')->get();
        return view('visitante.evento')->with('dia',$dia)->with('convites',$convites);
    }

    public function convidados(Request $request){
        if($request->dia == ''){
            $dia = date("Y-m-d");
        }else{
            $dia = date("Y-m-d",strtotime($request->dia));
        }
        $idusuario = session()->get('idusuario');
        $idempresa = session()->get('idempresa');
        
        $convidados = Convite::where('id_empresa',$idempresa)->where('id_usuario',$idusuario)->where('data',$dia)->where('assunto',$request->evento)->get();
        
       $html = '<table class="table table-sm">';
      
       $html .= '<thead>
                    <tr>
                    <th scope="col">'.$request->evento.'</th>
                    <th scope="col">Convidado</th>
                    <th scope="col">Email</th>
                    <th scope="col">Vaga</th>
                    
                    
                    </tr>
                </thead>
                <tbody>';
                    
            foreach ($convidados as  $c) {
                $confim = $c->confirmado;
                if($confim == 1){
                    $icon = '<i class="fa fa-check text-primary"  aria-hidden="true"></i>';
                }else{
                    $icon = '<i class="fa fa-exclamation text-warning "  aria-hidden="true"></i>';
                }
                $html .= '<tr>';
                $html .='<td>'.$icon.'</td>';
                $html .='<td>'.$c->nome_visitante.'</td>';
                $html .='<td>'.$c->email.'</td>';

               
                if($c->vaga == 1){
                    $html .='<td><button id="idConvite" value="'.$c->id.'" class="btn btn-light"><i class="fa fa-car text-success" aria-hidden="true"></i></button></td>';;
                }else{
                    $html .='<td><button id="idConvite" value="'.$c->id.'" class="btn btn-light"><i class="fa fa-car text-danger" aria-hidden="true"></i></button></td>';
                }
                
            
                $html .='</tr>';
            }
   
    $html .= '</tbody>';
    $html .= '</table>';

    return $html;
    

    }

    // função para verificar e disponibilizar vaga de estacionamento para visitante
    public function vaga(Request $request){
        if($request->dia == ''){
            $dia = date("Y-m-d");
        }else{
            $dia = date("Y-m-d",strtotime($request->dia));
        }

        $idempresa = session()->get('idempresa');
        $idusuario = session()->get('idusuario');
        $qtdVaga = Vaga::select('qtd_vagas')->where('id_empresa',$idempresa)->get();
        $qtdReservada = VagaReserva::where('id_empresa',$idempresa)->where('data_reserva',$dia)->count();
        $disponivel = $qtdVaga[0]['qtd_vagas'] - $qtdReservada;
        //pega o convite pelo ID
        $validaVaga = Convite::select('vaga','nome_visitante','email')->where('id',$request->idConvite)->get();

        if($validaVaga[0]['vaga']==1){
            $vaga = Convite::where('id',$request->idConvite)->update(['vaga'=>0]);// faz o update para 0
            // deleta a reserva existente comparando email, data e id_empresa
            $deletarVaga = VagaReserva::where('email',$validaVaga[0]['email'])->where('data_reserva',$dia)->where('id_empresa',$idempresa)->delete();
            return 0;
        }else{
            if($disponivel <1){
                return 'nd';//nao disponivel
            }
            $reservaVaga = VagaReserva::insert([
                'data_reserva'=>$dia,
                'id_empresa'=>$idempresa,
                'colaborador'=>$validaVaga[0]['nome_visitante'],
                'email'=>$validaVaga[0]['email'],
                'id_usuario'=>$idusuario,
                'placa'=>"xxx-0000",

            ]);
            $vaga = Convite::where('id',$request->idConvite)->update(['vaga'=>1]);
            return 1;
        }


                  /*
                        if($disponivel < 1 ){
                            return "nd";// não disponivel
                            
                        }else{
                            //pega o convite pelo ID
                            $validaVaga = Convite::select('vaga','nome_visitante','email')->where('id',$request->idConvite)->get();
                            // se o campo vaga for 1 ele faz o update para 0 
                            if($validaVaga[0]['vaga']==1){
                                $vaga = Convite::where('id',$request->idConvite)->update(['vaga'=>0]);// faz o update para 0
                                // deleta a reserva existente comparando email, data e id_empresa
                                $deletarVaga = VagaReserva::where('email',$validaVaga[0]['email'])->where('data_reserva',$dia)->where('id_empresa',$idempresa)->delete();
                                return 0;
                            }else{
                                $reservaVaga = VagaReserva::insert([
                                    'data_reserva'=>$dia,
                                    'id_empresa'=>$idempresa,
                                    'colaborador'=>$validaVaga[0]['nome_visitante'],
                                    'email'=>$validaVaga[0]['email'],
                                    'id_usuario'=>$idusuario,
                                    'placa'=>"xxx-0000",

                                ]);
                                $vaga = Convite::where('id',$request->idConvite)->update(['vaga'=>1]);
                                return 1;
                            }
                            
                            
                        }*/

           


    }

    public function getPlaca(Request $request){
        
      
        
        
        $upPlaca = VagaReserva::where('email','LIKE',"%".$request->email)
        ->where('id_empresa',$request->idempresa)
        ->where('data_reserva',$request->data)
        ->update(['placa'=>$request->placa]);

        $upConvite = Convite::where('id',$request->idConvite)->update(['placa'=>$request->placa]);

       return view('visitante.placaConfirme');
        
        
        




    }
      


}
