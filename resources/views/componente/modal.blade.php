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
                        <button type="submit" class="btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i> Finalizar</button>
                    </div>
                  

                </div> 

                
          @endif
         
         
        </form>   


        <form action="{{route('definirGrupo')}}" method="POST">
          @csrf
          <input type="hidden" name="getPosicaoGrupo" id="getPosicaoGrupo">
          @if (session()->get('perfil')=='adm')
                <a class="btn btn-outline-link" data-toggle="collapse" href="#roleAlertGrupo" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <i class="fa fa-caret-down" aria-hidden="true"></i> Definir Grupo</a><p class=""></p>
               <div class="alert alert-warning text-center collapse" role="alert" id="roleAlertGrupo">
                   
                    <p></p>
                    <hr>
                    <div id="info_bloqueio">
                        <label for="finalidade" ><b>Escolha Grupo</b></label>
                        @isset($grupos)
                        <select class="custom-select custom-select-sm" id="selectGrupo" name="selectGrupo">
                          <option value="vaga">Posição Vaga</option>
                            @foreach ($grupos as $g)
                            
                              <option selected value="{{$g->id_grupo}}|{{$g->nome_grupo}}|{{$g->cor}}">{{$g->nome_grupo}}</option>
                              
                            
                            
                            @endforeach
                          </select>
                        @endisset
                      
                        <p></p>
                        
                        <hr>
                        <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-check" aria-hidden="true"></i> Definir</button>
                    </div>
                  

                </div> 

                
          @endif
         
         
        </form> 

        </div>
        
         
          
        </div>
     
      </div>
    </div>
  </div>