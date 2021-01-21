@extends('template.tempvisitante')

@section('conteudo')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-link text-info" id="addNew"><i class="fa fa-address-book-o text-info" aria-hidden="true"></i> Novo Visitante</button>  
                <form class="form-inline" id="newvisitante">
                    @csrf
                        <div class="form-group mx-sm-3 mb-2">
                        <label for="nome" class="sr-only">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome Visitante *" >
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="email" class="sr-only">E-mail</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email@visitante *" style="width: 360px" >
                        </div>
                        <button type="button" class="btn btn-primary mb-2" id="salvar">Salvar</button>
                                              
                  </form>
                  <div id="resultado" class="container"></div>
                  <hr>      
                <div class="input-group input-group-sm mb-3">
                  
                    <input type="text" class="form-control" aria-label="Small" id="pesquisa" placeholder="Pesquisa" name="pesquisa">
                    <div class="input-group-prepend">
                        <button class="input-group-text btn btn-outline-info" id="addvisitante"><i class="fa fa-plus" aria-hidden="true"></i></button> 
                    </div> 
                    
                    <div id="pesquisaList" class="container" ></div>                                           
                </div>

              
            </div>
            <div class="card-footer text-muted">
            <form method="POST" action="{{route('enviaConvite')}}">
                @csrf
                    <div class="form-group">
                        <input type="hidden" id="nome_user" name="nome_user">
                      <label for="exampleInputEmail1"><h4>Convite </h4> @isset($result)
                        <i class="fa fa-check-circle-o text-info" aria-hidden="true"></i>
                      @endisset </label>
                      <div class="text-right"><a href="#" id="limpar">Limpar</a></div>
                      <input type="text" class="form-control" id="participantes" name="participantes"  placeholder="Participantes" required readonly>
                      
                      
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Assunto</label>
                        <input type="text" class="form-control" id="assunto" name="assunto"  placeholder="Assunto" required>
                        
                        
                      </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Data Inicio</label>
                        <input type="datetime-local" class="form-control" id="data" name="data"  placeholder="Participantes" required>
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Data Término</label>
                        <input type="datetime-local" class="form-control" id="dataT" name="dataT"  placeholder="Participantes" required>
                        
                      </div>
                      
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descrição Convite</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" id="txtDesc" name="txtDesc" required></textarea>
                    </div>
                    
                    <div class="text-center"><button type="submit" class="btn btn-primary">Convidar</button></div>
                  </form>
                 
            </div>

           
          </div>
    </div>
    
     
@endsection
