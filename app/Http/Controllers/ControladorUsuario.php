<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\Reserva;
use App\ReservaSala;
use App\VagaReserva;
use App\Grupo;
use App\CentroCusto;


class ControladorUsuario extends Controller
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
        $idempresa = session()->get('idempresa');
        $colab = Reserva::where('data_reserva',$data)->where('empresa_idempresa',$idempresa)->get();
        $minhasSalas = ReservaSala::where('id_empresa',$idempresa)->where('data_inicio',$data)->orderBy('hora_inicio')->get();
        $minhasVagas = VagaReserva::where('id_empresa',$idempresa)->where('data_reserva',$data)->orderBy('data_reserva')->get();

        //ira retornar os colaboradores somente das posições(layout)
       return view('colaborador')
       ->with("colabs",$colab)
       ->with("minhasSalas",$minhasSalas)
       ->with("minhasVagas",$minhasVagas)
       ->with('dia',$data);
    }


// CONSULTA OS COLABORADORES NAS GARAGENS (RESERVAS DE GARAGEM)
    public function colabgaragem()
    {
        $idempresa = session()->get('idempresa');
        $user = Usuario::where('empresa_idempresa',$idempresa)->where('deleted_at',null)->get();
        return view('estacionamento.colabgaragem')->with('colab',$user);
    }

    public function usergaragem()
    {
        return view('estacionamento.minhasreservas');
    }


    public function elegivel(Request $request)
    {
        $idusuario = $request->id;
        $idempresa = session()->get('idempresa');
        $aut = 0;
        $garagem = Usuario::select('garagem')->where('idusuario',$idusuario)->where('empresa_idempresa',$idempresa)->get();
        $jsongaragem = json_decode($garagem,true);
        
        foreach($jsongaragem as $j){
            $autGaragem =  $j['garagem'];
        }
        
        if($autGaragem == 1){
            $update= Usuario::where('idusuario',$idusuario)->where('empresa_idempresa',$idempresa)->update(["garagem"=>0]);
        }else{
            $update= Usuario::where('idusuario',$idusuario)->where('empresa_idempresa',$idempresa)->update(["garagem"=>1]);
        }
        
         return redirect()->route('colabgaragem');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $idempresa = session()->get('idempresa');
        $grupos = Grupo::where('id_empresa',$idempresa)->get();
        $centroCusto = CentroCusto::where('id_empresa',$idempresa)->where('deleted_at',null)->get();
        return view('usuario.newuser')
        ->with('centroCusto',$centroCusto)
        ->with('grupos',$grupos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $dadosCentro = explode('|',$request->selectCC);

        $mensagens =[
            'nome.required'=> 'Informe o nome do colaborador!',
            'email.required'=> 'Campo E-mail é Obrigatório!',
            'email.email'=> 'Informe um E-mail válido',
            'email.unique:usuario'=> 'Ops! este E-mail já está em uso',
            'senha.required'=> 'Campo Senha é Obrigatório!',
           

        ];
        $request->validate([
            'nome'=> 'required',
            'email'=>'required|unique:usuario',
            'senha'=> 'required',
            

        ],$mensagens);

        $usuario = new Usuario();
        $usuario->empresa_idempresa = $request->empresa;
        $usuario->nome_usuario = $request->nome;
        $usuario->email = $request->email;
        $usuario->senha = $request->senha;
        $usuario->perfil = $request->perfil;
        $usuario->id_centroCusto = $dadosCentro[0];// neste array esta o id do centro de custo
        $usuario->centroCusto = $dadosCentro[1]; // neste array esta o nome do centro de custo
        $usuario->id_grupo = $request->selectGrupo;
        if($request->sim){
            $usuario->garagem = 1;
        }else{

        $usuario->garagem = 0;

        }
        $usuario->save();
                
        //return view('usuario.newuser')->with('ok','ok');
        return redirect()->back()->with(['ok'=>'ok']);
        
    }
// atualiza a senha
    public function atualizasenha(Request $request)
    {
        $upSenha = Usuario::where('email',$request->email)->update(["senha"=>$request->novasenha,"acesso"=>1]);
        return view('login')->with('user',$request->email);
    }

    public function listaUsuario(){
        $idempresa = session()->get('idempresa');

        $usuario = Usuario::where('empresa_idempresa',$idempresa)->where('deleted_at',null)
        ->orderBy('nome_usuario')->get();

        return view('usuario.listausuario')->with('usuario',$usuario);
    }
  
    public function editUser(Request $request){
        $idempresa = session()->get('idempresa');
        $idUser = $request->idUser;
        $usuario = Usuario::where('idusuario',$idUser)->where('empresa_idempresa',$idempresa)->get();
        $centroCusto = CentroCusto::where('id_empresa',$idempresa)->where('deleted_at',null)->get();
        $grupos = Grupo::where('id_empresa',$idempresa)->get();
        return view('usuario.edituser')
        ->with('grupos',$grupos)
        ->with('centroCusto',$centroCusto)
        ->with('usuario',$usuario);
    }

    public function atualizaUser(Request $request){
        //dd($request->all());
        if($request->selectCC !='|'){
         $dadoCentro = explode('|',$request->selectCC);
         $up = Usuario::where('empresa_idempresa',$request->empresa)
         ->where('idusuario',$request->iduser)
         ->update([
            'nome_usuario'=> $request->nome,
            'email'=> $request->email,
            'perfil'=> $request->perfil,
            'id_centroCusto'=>$dadoCentro[0],
            'centroCusto'=> $dadoCentro[1],
            'id_grupo'=> $request->selectGrupo
 
 
         ]);
 
        }else{
         $dadoCentro = explode('|',$request->selectCC);
         $up = Usuario::where('empresa_idempresa',$request->empresa)
         ->where('idusuario',$request->iduser)
         ->update([
            'nome_usuario'=> $request->nome,
            'email'=> $request->email,
            'perfil'=> $request->perfil,
            'id_centroCusto'=>null,
            'centroCusto'=> null,
            'id_grupo'=> $request->selectGrupo
 
 
         ]);
 
        }
         
          if($up){
             return redirect()->route('listaUsuario');
          }else{
             return back()->with('error','Ops! Algo errado na Atualização');
          }
     }
 

     public function deletaUsuario(Request $request){
        $idempresa = session()->get('idempresa');
        $idUser = $request->idUser;
        $diaHoje = date('Y-m-d');

        // realizar a tecnica de Softdelete no usuario
        $user = Usuario::where('empresa_idempresa',$idempresa)
        ->where('idusuario',$idUser)->update
        (['deleted_at'=>$diaHoje
               
        ]);
        
        if($user){
            $reservas = Reserva::where('usuario_idusuario',$idUser)->where('data_reserva','>=',$diaHoje)->delete();
         
        }
                
       
        return redirect()->back();
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
