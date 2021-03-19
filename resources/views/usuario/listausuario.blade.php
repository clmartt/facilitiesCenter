@extends('template.templayout')

@section('layout')
    <div class="container">
        <div class="card">
            <div class="card-header">
              Lista de Usuários
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Grupo</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">CC</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                          </tr>
                        </thead>
                        <tbody>
                            @isset($usuario)
                            
                                @foreach ($usuario as $u)
                               
                                <tr>
                                  <th>{{$u->nome_usuario}}</th>
                                  <td>{{$u->email}}</td>
                                  <td>{{$u->grupo->nome_grupo}}</td>
                                  <td>{{$u->perfil}}</td>
                                  <td>{{$u->centroCusto}}</td>
                                  <td><a class="btn btn-link text-info" href="{{route('editUser',['idUser'=>$u->idusuario])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                  </td>
                                  <td><button class="btn btn-link text-danger"  value="{{$u->idusuario}}|{{$u->nome_usuario}}" id="deleteUsuarioLixo"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                </tr>
                                @endforeach
                            @endisset
                         
                      
                        </tbody>
                      </table>
                  </div>
            </div>
            <div class="card-footer">

            </div>
          </div>
    </div>
   


<!-- Modal -->
<div class="modal fade" id="confirmarExclusaoUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar a Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="{{route('deletaUsuario')}}" method="POST">
          @csrf
          <input type="hidden" id="idUsuarioParaExcluir" name="idUser">
               
        Deseja Realmente realizar a exclusão do Usuario <b><span id="nomeUsuarioExcluir"></span>?</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-danger"  href="{{route('deletaUsuario')}}">Confirmar</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection