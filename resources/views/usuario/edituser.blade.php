@extends('template.templayout')

@section('layout')

    <div class="container">
    
        <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 50rem;">
            <div class="card-header">
                        <b>Editar Usuário </b> 
            </div>
            <div class="card-body">
                      <form method="POST" action="{{route('atualizaUser')}}" autocomplete="off">
                            @csrf
                            @isset($usuario)
                                @foreach ($usuario as $u)
                                <input type="hidden" name="empresa" value="{{session()->get('idempresa')}}">
                                <input type="hidden" name="iduser" value="{{$u->idusuario}}">
                                
                                <div class="form-group">
                                    <label for="nome">Nome *</label>
                                <input type="text" class="form-control " id="nome" name="nome" value="{{$u->nome_usuario}}" required>
                                </div>
                                <div class="form-group">
                                  
                                  <label for="email">E-mail *</label>
                                  <input type="email" class="form-control"  id="email" name="email" value="{{$u->email}}" required >
                                
                                </div>
                                                            
                                <div class="form-group">
                                    <label for="perfil">Perfil</label>
                                    <select class="custom-select" id="perfil" name="perfil">
                                       
                                        <option value="user" {{$u->perfil == 'user'? 'selected':'' }}>user</option>
                                        <option value="adm" {{$u->perfil == 'adm'? 'selected':'' }}>adm</option>
                                        
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="perfil">Centro de Custo</label>
                                    <select class="custom-select" id="selectCC" name="selectCC">
                                        <option value="{{$u->id_centroCusto}}|{{$u->centroCusto}}" selected>{{$u->centroCusto}}</option>
                                       @isset($centroCusto)
                                           @foreach ($centroCusto as $cc)
                                           <option value="{{$cc->id}}|{{$cc->centroCusto}}">{{$cc->centroCusto}}</option>
                                           @endforeach
                                  
                                       @endisset
                                       
                                        
                                      </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="perfil">Grupo</label>
                                    <select class="custom-select" id="selectGrupo" name="selectGrupo">
                                        <option value="{{$u->grupo->id_grupo}}" selected>{{$u->grupo->nome_grupo}} </option>
                                      @isset($grupos)
                                      @foreach ($grupos as $g)
                                          <option value="{{$g->id_grupo}}">{{$g->nome_grupo}}</option>
                                      @endforeach
                             
                                  @endisset
                                        
                                      </select>
                                  </div>
                                  @if (session()->get('estacionamento')== 1)
                                      <div class="form-group">
                                        <label for="senha">Estacionamento ? &ensp; </label>
                                        
                                          <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="sim" id="sim" value="true">
                                            <label class="form-check-label" for="sim"><i class="fa fa-car" aria-hidden="true"></i></label>
                                          </div>
                                          
                                      </div>
                                  @endif
                                @endforeach
                            @endisset
                          
                              
                            <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </form>
              </div>
                      
              
              
          </div>

    </div>
    
@endsection