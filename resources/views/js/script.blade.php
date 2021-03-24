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
            $("#getPosicaoGrupo").val('');
           // $("#dia").val('');
           $("#email_user").val("");
           $("#motivo_block").val("");
            $("#title").append(idpos);
            $("#getPosicao").val(idpos);
            $("#getPosicaoGrupo").val(idpos);
            $("#nomePosicao").val(idpos);
            $('#modalposicao').modal("show");
        });

        
        var posicaophp = "{{$arrayPosicao ?? ''}}";// todas as posições reservadas
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
          
            // botao de editar grupo
         $(document).on('click','#btnEditarGrupo',function(){
            var infoGrupo = $(this).val();
            var infoGrupoArray = infoGrupo.split("|");
           // alert(infoGrupoArray[0]) aqui esta o ID do grupo;
           //alert(infoGrupoArray[1]) aqui estao NOME do grupo;
          //alert(infoGrupoArray[2]) aqui esta a COR do grupo;
          $('#novoNomeGrupo').empty();
          $('#novoNomeGrupo').val(infoGrupoArray[1]);
          $('#novaCor').empty();
          $('#novaCor').val(infoGrupoArray[2]);
          $('#txtIdGrupo').empty();
          $('#txtIdGrupo').val(infoGrupoArray[0]);
          $('#editaGrupo').modal('show');
         });

             // botao de excluir grupo
             $(document).on('click','#btnExcluirGrupo',function(){
              var confirmar = confirm("As posição deste Grupo serão definidas como Vagas!");
                // alert(infoGrupoArray[0]) aqui esta o ID do grupo;
                //alert(infoGrupoArray[1]) aqui estao NOME do grupo;
                //alert(infoGrupoArray[2]) aqui esta a COR do grupo;
              if(confirmar){
                var tokenP = $('input[name="_token"]').val();
                var infoGrupo = $(this).val();
                var infoGrupoArray = infoGrupo.split("|");
                      $.ajax({
                              url : "{{route('deletaGrupo')}}",
                              type : 'post',
                              data : {
                                    idGrupo : infoGrupoArray[0],
                                    _token: tokenP,
                                    
                                    
                              },
                              beforeSend : function(){
                                $("#tdExcluirGrupo"+infoGrupoArray[0]).empty();
                                  $("#tdExcluirGrupo"+infoGrupoArray[0]).
                                  html('<div class="spinner-border spinner-border-sm text-danger" role="status"><span class="sr-only">Loading...</span></div>');
                              }
                              })
                              .done(function(msg){
                                window.location.reload();
                              
                              })
                              .fail(function(msg){
                                console.log(msg)
                              });
                
              }





            });

    })




    $(function(){
        $('#alterarqtd').hide();

        $("#qtd").click(function(){
          $('#alterarqtd').fadeIn('slow');
        })

        $('#close').click(function(){
          $('#alterarqtd').fadeOut('slow');
        })
      })

     
      $(document).on('click','#deleteUsuarioLixo',function(){
        var iduser = $(this).val();
        var dadosUser = iduser.split("|");
        $('#idUsuarioParaExcluir').val("");
        $('#nomeUsuarioExcluir').empty();
        $('#idUsuarioParaExcluir').val(dadosUser[0]);
        $('#nomeUsuarioExcluir').append(dadosUser[1]);
        $('#confirmarExclusaoUsuario').modal('show');

      })

      $(document).on('click','#excluirCC',function(){
        var idCC = $(this).val();
        var dadosCC = idCC.split("|");
        $("#nomeCentroCusto").empty();
        $("#idCentroParaExcluir").val('');
        $("#idCentroParaExcluir").val(dadosCC[0]);
        $("#nomeCentroCusto").append(dadosCC[1])
        $('#confirmarExclusaoCC').modal('show');

      })




  </script>