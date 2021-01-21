<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/icone/css/font-awesome.min.css")}}">
   
    <link rel="stylesheet" href="{{asset("css/cssdivs.css")}}">
     <script src="{{asset('js/jquery.js')}}"></script>
    
    
    <title>Gestao de Posições</title>

    @isset($arrayPosicao)
      
    
   
    <script>
        $(function(){
          // esconde os inputs email_user e motivo_block
              $("#email_user").hide();
              $("#labelPara").hide();
              $("#motivo_block").hide();
              $("#labelMotivo_block").hide();

              // pega o valor do select FInalidade
               $("#finalidade").change(function(){
                 var finalidade = $(this).val();
                      if(finalidade == 'exclusivo'){
                        $("#motivo_block").hide();
                        $("#labelMotivo_block").hide();
                        $("#labelPara").fadeIn('slow');
                        $("#email_user").fadeIn('slow');
                      }
                      if(finalidade == 'restrição'){
                        $("#email_user").hide();
                        $("#labelPara").hide();
                        $("#labelMotivo_block").fadeIn('slow');
                        $("#motivo_block").fadeIn('slow');
                      } 
               });
          
            // tornas as divs 'posicao' em clicavel abrindo tambem o modal
            $(".posicao").click(function(){
                var idpos = $(this).attr('id');
                $("#title").empty();
                $("#getPosicao").val('');
               // $("#dia").val('');
               $("#email_user").val("");
               $("#motivo_block").val("");
                $("#title").append(idpos);
                $("#getPosicao").val(idpos);
                $("#nomePosicao").val(idpos);
                $('#modalposicao').modal("show");
            });

            
            var posicaophp = "{{$arrayPosicao ?? ''}}";
            var arrayNomePosicao = posicaophp.split("|");
            if(arrayNomePosicao != ''){
                  for(i in arrayNomePosicao ){
                     $("#"+arrayNomePosicao[i]).css("background-color","red").off('click');
                  }
            }
            


                  var block = '{{$bloqueadas ?? ""}}';
                  if(block !== ""){
                        var blockArray = block.split("|");

                        for(i in blockArray){
                          
                          $("#"+blockArray[i]).css("background-color","yellow").off('click');
                        }
                  }


               

            


                
           
            
        });

        
    </script>
  @endisset

 

  </head>
  <body>
   
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 bg-white rounded ">
       
       <a class="navbar-brand "  href="{{route('backmodulo')}}">
         <i class="fa fa-street-view text-primary" aria-hidden="true"></i>
                Facilities Center
            </a>
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="{{route('posicoes')}}"> <i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a class="nav-item nav-link active" href="{{route('reservas')}}"> <i class="fa fa-calendar" aria-hidden="true"></i> Minhas reservas</a>
            @if (session()->get('perfil')== 'adm')
            <a class="nav-item nav-link active" href="{{route('bloqueadas')}}"> <i class="fa fa-lock" aria-hidden="true"></i> Posiçoes Bloqueadas</a>
            @endif
            <a class="nav-item nav-link active" href="{{route('colaborador')}}"> <i class="fa fa-user-circle-o" aria-hidden="true"></i> Colaboradores</a>
         
             <form class="form-inline" method="GET" action="{{"/".$route = Route::current()->getName()}}">
              @csrf
                <input type="hidden" value="{{$sala ?? ''}}" name="sala"> 
                <input class="form-control mr-sm-2 border border-primary" type="date" name="dia">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
             </form>
            </div>
        </div>
       
            
            @component('componentes.botaoUser')
                
            @endcomponent 
    </nav>

        @yield('layout')









   
  <!-- Modal -->
  <div class="modal fade" id="modalposicao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Posição Selecionada : <span id="title"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('salvaPosicao')}}" method="POST">
                @csrf
                <input type="hidden" id="nomePosicao" name="nomePosicao">
                <div class="form-group">
                  <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{session()->get('nome')}}">
                  
                </div>
                <div class="form-group">
                  <label for="dia">Data</label>
                <input type="date" class="form-control" id="dia" name="dia" @isset($dia)
                    
                @endisset value="{{$dia ?? ''}}">
                </div>
                <div class="text-center">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  <button type="submit" class="btn btn-primary" >Salvar</button>  
                </div>
                
        </form>
        <hr>
        <form action="{{route('block')}}" method="POST">
          @csrf
          <input type="hidden" name="getPosicao" id="getPosicao">
          @if (session()->get('perfil')=='adm')
                <a class="btn btn-outline-link" data-toggle="collapse" href="#roleAlert" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <i class="fa fa-caret-down" aria-hidden="true"></i> Bloquear Posição</a><p class=""></p>
               <div class="alert alert-warning text-center collapse" role="alert" id="roleAlert">
                   
                    <p></p>
                    <hr>
                    <div id="info_bloqueio">
                        <label for="finalidade" ><b>Finalidade</b></label>
                        <select class="custom-select custom-select-sm" id="finalidade" name="finalidade">
                          <option selected value="exclusivo">Selecione Finalidade</option>
                          <option value="exclusivo">Uso Exclusivo</option>
                          <option  value="restrição">Restrição de Uso</option>
                        
                        </select>
                        <p></p>
                        <label for="email_user" id="labelPara"><b>Para </b>: <small class="text-muted">(email Colaborador)</small> </label><br>
                        <input class="form-control form-control-sm" type="text" placeholder="Digite o Email" id="email_user" name="email_user"><p></p>
                        <label for="motivo_block" id="labelMotivo_block"><b>Motivo da Restrição</b></label>
                        <textarea class="form-control" id="motivo_block" name="motivo_block" rows="2"></textarea>
                        <hr>
                        <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-lock" aria-hidden="true"></i> Finalizar</button>
                    </div>
                  

                </div> 
          @endif
         
         
        </form>   
        </div>
        
         
          
        </div>
     
      </div>
    </div>
  </div>



    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>