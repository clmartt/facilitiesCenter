@extends('template.templayout')


@section('layout')
<div class="card">
    <div class="card-header">
      Novo Grupo
    </div>
    <div class="card-body">
        <form method="POST" action="{{route('salvaGrupo')}}">
            @csrf
            <div class="form-group">
              <label for="nomeGrupo">Nome do Grupo</label>
              <input type="text" class="form-control" id="nomeGrupo" name="nomeGrupo" placeholder="Nome do Grupo">
              
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Cor</label>
              <input type="color" class="form-control" id="corGrupo" name="corGrupo" placeholder="Password" style="width: 50px">
             
            </div>
           
            <div class="text-center"><button type="submit" class="btn btn-primary">Salvar</button></div>
          </form>
    </div>
    <div class="card-footer text-center">
        @isset($retorno)
            @if ($retorno == '1')
            <div class="alert alert-primary" role="alert">
                Grupo criado com sucesso!
              </div>
            @else
            <div class="alert alert-danger" role="alert">
                Ops!, Algo errado aconteceu.
              </div>
            @endif
        @endisset
    </div>
  </div>
@endsection