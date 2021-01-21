<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/icone/css/font-awesome.min.css")}}">
    <title>Gestao de Visitantes</title>

    <script src="{{asset('js/jquery.js')}}"></script>
   





  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 bg-white rounded">
       
        <a class="navbar-brand"  href="{{route('backmodulo')}}">
          <i class="fa fa-id-card-o text-primary" aria-hidden="true"></i>
                Facilities Center 
            </a>
       
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link active" href="{{route('visitante')}}"> <i class="fa fa-home" aria-hidden="true"></i> Home</a>
              <a class="nav-item nav-link active" href="{{route('convite')}}"> <i class="fa fa-id-card-o" aria-hidden="true"></i> Convite</a>
              
               
          
                        
           
            <form class="form-inline" method="GET" action="{{"/".$route = Route::current()->getName()}}" style="margin-left:30px">
              {{ csrf_field() }}
                <input type="hidden" value="{{$sala ?? ''}}" name="sala"> 
                <input class="form-control mr-sm-2 border border-primary" type="date" name="dia">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
             </form>
          
            </div>
        </div>
        <form class="form-inline">
           @component('componentes.botaoUser')
               
           @endcomponent
        </form>
    </nav>
        @yield('conteudo')





    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
   <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
    <script>
      $(function(){
          $("#newvisitante").hide();

          $("#addNew").click(function(){
            $("#newvisitante").toggle('slow');
            $("#resultado").empty();
          });



          $("#salvar").click(function(){
            
            var nome = $("#nome").val();
            var email = $("#email").val();
            var token = $('input[name="_token"]').val();

            $.ajax({
              url : "{{route('salvarVisitante')}}",
              type : 'post',
              data : {
                    nome : nome,
                    email :email,
                    _token: token
              },
              beforeSend : function(){
                    $("#resultado").html('<img src="{{asset('img/load.gif')}}" >');
              }
              })
              .done(function(msg){
                if(msg == 1){
                  $("#resultado").html('<div class="alert alert-danger" role="alert">E-mail já cadastrado!</div>');
                  $("#email").addClass("border border-danger");
                  return
                }
                if(msg == 2){
                  $("#resultado").html('<div class="alert alert-danger" role="alert">Nome Obrigatório!</div>');
                  $("#nome").addClass("border border-danger");
                  return
                }
                if(msg == 3){
                  $("#resultado").html('<div class="alert alert-danger" role="alert">E-mail Obrigatório!</div>');
                  $("#nome").addClass("border border-danger");
                  return
                }

                $("#nome").removeClass("border border-danger");
                $("#email").removeClass("border border-danger");
                $("#resultado").empty();
                $("#resultado").html('<div class="alert alert-primary" role="alert">Salvo com sucesso!</div>');
                $("#nome").val("");
                $("#email").val("");
              
              })
              .fail(function(msg){
                $("#resultado").append(msg);
              });
            });

            $("#pesquisa").keyup(function(){
              var query = $(this).val();
              var tokenP = $('input[name="_token"]').val();
              $.ajax({
                  url:"{{route('pesquisa')}}",
                  method: "POST",
                  data:{
                    query:query,
                    _token:tokenP
                  },
                  beforeSend:function(){
                    $("#pesquisaList").append('...');
                  },
                  success:function(data){
                    $("#pesquisaList").fadeIn();
                    $("#pesquisaList").html(data);
                  }
                });
            })

            $(document).on('click','li',function(){
              $("#pesquisa").val($(this).text());
              $("#pesquisaList").fadeOut();
            })

            var convidados = [];
            var nomes = [];
            $("#addvisitante").click(function(){
             
             var pesquisa = $("#pesquisa").val();
             if(pesquisa == ""){
               return;
             }
             var pesquisaEmail = pesquisa.split("|");
             convidados.push(pesquisaEmail[1]);
             nomes.push(pesquisaEmail[0]);
             $("#pesquisa").val("");
             $("#participantes").empty();
             $("#participantes").val(convidados);
             $("#nome_user").val(nomes);
         
             

            })

            $("#limpar").click(function(){
              event.preventDefault();
              convidados= [];
              nomes = [];
              $("#participantes").val("");
            })

            $(document).on('click','#evento',function(){
              event.preventDefault();
              var token = $('input[name="_token"]').val();
              var evento = $(this).text();
              
                          $.ajax({
                          url : "{{route('convidados')}}",
                          type : 'post',
                          data : {
                                evento : evento,
                                _token: token,
                                dia: "{{$dia ?? ''}}"
                                
                          },
                          beforeSend : function(){
                            $("#resultado").empty();
                              $("#resultado").html('<img src={{asset("img/load.gif")}}>');
                          }
                          })
                          .done(function(msg){
                            $("#resultado").empty();
                            $("#resultado").html(msg);
                          
                          })
                          .fail(function(msg){
                            $("#resultado").empty();
                            $("#resultado").append(msg);
                          });
              });



              $(document).on('click','#idConvite',function(){
              event.preventDefault();
              var token = $('input[name="_token"]').val();
              var idConvite = $(this).val();
              
                          $.ajax({
                          url : "{{route('visitante.vaga')}}",
                          type : 'post',
                          data : {
                                idConvite : idConvite,
                                _token: token,
                                dia: "{{$dia ?? ''}}"
                                
                          },
                          beforeSend : function(){
                            $("#resultado").empty();
                              $("#resultado").html('<img src={{asset("img/load.gif")}}>');
                          }
                          })
                          .done(function(msg){
                            
                            
                            $("#resultado").empty();
                            if(msg == 0){
                              alert("Reserva Excluída");
                            }
                            if(msg == 1){
                              alert("Reserva Realizada");
                            }
                            
                            if(msg == 'nd'){
                              alert("Não há vagas disponiveis!");
                            }
                            
                           
                          
                          })
                          .fail(function(msg){
                            alert(msg);
                          });
              });
            

            

      })





    </script>
                 
  </body>
</html>