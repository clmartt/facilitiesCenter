@extends('template.tempposicoes')

@section('layout')

    <div class="row justify-content-md-center">
        <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 28rem;">
            <div class="card-header">
              @if ($ok ?? "")
              <div class="alert alert-primary" role="alert">
                Salvo com Sucesso!
              </div>
              
              @else
                  Novo Colaborador
              @endif
              
            </div>
            <div class="card-body">
                      <form method="POST" action="{{route('salvauser')}}">
                            @csrf
                            <input type="hidden" name="empresa" value="{{session()->get('idempresa')}}">
                            <div class="form-group">
                                <label for="nome">Nome *</label>
                            <input type="text" class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" id="nome" name="nome" placeholder="Informe Nome" value="{{old('nome')}}">
                                @if ($errors->has('nome'))
                                    <div class="invalid-feedback">
                                      {{$errors->first('nome')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                              <label for="email">E-mail *</label>
                            <input type="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="email" name="email" placeholder="Informe email" value="{{old('email')}}">
                            @if ($errors->has('email'))
                                  <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                  </div>
                             @endif
                            </div>
                            <div class="form-group">
                              <label for="senha">Senha Provisória *</label>
                              <input type="password" class="form-control btn btn-outline-warning {{$errors->has('senha') ? 'is-invalid' : ''}}" id="senha" name="senha" placeholder="Senha Provisória">
                              @if ($errors->has('senha'))
                                    <div class="invalid-feedback">
                                      {{$errors->first('senha')}}
                                    </div>
                              @endif
                            </div>
                            <div class="form-group">
                                <label for="perfil">Perfil</label>
                                <select class="custom-select" id="perfil" name="perfil">
                                   
                                    <option value="user">user</option>
                                    <option value="adm">adm</option>
                                    
                                  </select>
                              </div>
                              <div class="form-group">
                                <label for="senha">Área</label>
                              <input type="senha" class="form-control" id="area" name="area"  value="{{old('area')}}" placeholder="Área do Colaborador" >
                              </div>
                              <div class="form-group">
                                <label for="senha">Gestor</label>
                                <input type="senha" class="form-control" id="gestor" name="gestor"  value="{{old('gestor')}}" placeholder="Gestor do Colaborador">
                              </div>
                              <div class="form-group">
                                <label for="senha">Estacionamento ? &ensp; </label>
                                
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="sim" id="sim" value="true">
                                    <label class="form-check-label" for="sim"><i class="fa fa-car" aria-hidden="true"></i></label>
                                  </div>
                                  
                              </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
              </div>
                      
              
              
          </div>

    </div>
    
@endsection