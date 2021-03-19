<?php




namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Usuario;
use App\Empresa;
use App\Grupo;
use Illuminate\Support\Facades\Session;

class ControladorLogar extends Controller
{
   public function logar(Request $request){

   
      //recebe os dados do form de login
      //abaixo verifica o email e senha do usuario
      $usuario = Usuario::where('email',$request->input('email'))->where('senha',$request->input('senha'))->get();
      $json = json_decode($usuario);
      if(empty($json)){// se nao retornar valor envia uma mensagem de erro
         
         return view("login")->with("erro","Ops! Algo errado com login...");
         
      }else {
      
        
         
        foreach ($usuario as $key=> $value) {
           if($value['acesso']== 0 )
           {
              return view('novasenha')->with('user',$json);
            }
                             
           //pega a empresa que possui o id da empresa na consulta acima do usuario
           $empresa = Empresa::where('idempresa',$value['empresa_idempresa'])->get();
           $perfil = $value['perfil'];
           $nome = $value['nome_usuario'];
           // guarda tudo em session
           session()->put('idusuario',$value['idusuario']);
           session()->put('email',$value['email']);
           session()->put('nome',$value['nome_usuario']);
           session()->put('empresa',$value['empresa_idempresa']);
           session()->put('perfil',$value['perfil']);
           session()->put('garagem',$value['garagem']);
           session()->put('idGrupo',$value['id_grupo']);
        }
      

        foreach($empresa as $value){
           // pega as informaçoes da empresa e guarda em session
           $idEmpresa = $value['idempresa'];
           $office = $value['office'];
           session()->put('idempresa',$value['idempresa']);
           session()->put('nomeEmpresa',$value['nome_empresa']);
           session()->put('office',$value['office']);
           session()->put('posicao',$value['posicoes']);
           session()->put('estacionamento',$value['estacionamento']);
           session()->put('salas',$value['salas']);
           session()->put('visitantes',$value['visitantes']);

        }

        
        
        
        // pegando informações do grupo 
        $infogrupo = Grupo::where('id_empresa',session()->get('idempresa'))
        ->where('id_grupo',session()->get('idGrupo'))->get();
        session()->put('nomeGrupo',$infogrupo[0]['nome_grupo']);
        session()->put('corGrupo',$infogrupo[0]['cor']);

        // chama o metodo da api 
         $viewData = $this->loadViewData();
         return redirect('/posicoes');
                
      }
   }

   public function index(){
      $nome = session()->get('nome');
      return view('modulos')->with('nome',$nome)->with('nome',$nome);
      

   }

   public function login(){
      
      return view('login');

   }
 
}
