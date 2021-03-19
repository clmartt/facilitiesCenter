@extends('template.templayout')

@section('layout')
    <div class="container">
        <div class="card">
            <div class="card-header">
              <b>Grupos</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Cor</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                          </tr>
                        </thead>
                        <tbody>
                            @isset($grupos)
                                @foreach ($grupos as $g)
                                    <tr>
                                        <th scope="row"><input type="color" value="{{$g->cor}}" disabled></th>
                                        <td>{{$g->nome_grupo}}</td>
                                        <td><button class="btn btn-link" value="{{$g->id_grupo}}|{{$g->nome_grupo}}|{{$g->cor}}" id="btnEditarGrupo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                                        <td id="tdExcluirGrupo{{$g->id_grupo}}">
                                            <button class="btn btn-link text-danger" value="{{$g->id_grupo}}" id="btnExcluirGrupo"><i class="fa fa-trash" aria-hidden="true"></i></button> 
                                        </td>
                                    </tr>
                                @endforeach
                            
                            @endisset
                         
                      
                        </tbody>
                      </table>
                  </div>
            </div>
          </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="editaGrupo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar Grupo </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{route('salvaEditarGrupo')}}">
                @csrf
                <input type="hidden" id="txtIdGrupo" name="txtIdGrupo">
                <div class="form-group">
                  <label for="novoNomeGrupo">Nome do Grupo</label>
                  <input type="text" class="form-control" id="novoNomeGrupo"  name="novoNomeGrupo">
                  
                </div>
                <div class="form-group">
                  <label for="novaCor">Cor</label>
                  <input type="color" class="form-control" id="novaCor" name="novaCor" style="width: 50px" >
                </div>
         
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Atualizar</button>
          @isset($status)
              @if ($status == 1)
              <div class="alert alert-primary" role="alert">
                Informações atualizadas!!!
              </div>
              @else
              <div class="alert alert-danger" role="alert">
                Ops! Algo errado.
              </div>
              @endif
          @endisset
        </div>
      </div>
    </form>
    </div>
  </div>
@endsection