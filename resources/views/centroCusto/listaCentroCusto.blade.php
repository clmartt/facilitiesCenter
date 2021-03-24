@extends('template.templayout')

@section('layout')
    <div class="container">
        <div class="card">
            <div class="card-header">
              Centro de Custos
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">CC</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Área</th>
                        <th scope="col">Gestor</th>
                        <th scope="col">Diretor</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                      </tr>
                    </thead>
                    <tbody>
                        @isset($cc)
                            @foreach($cc  as $c)
                            <tr style="font-size: 14px">
                                <th scope="row">{{$c->centroCusto}}</th>
                                <td>{{$c->nome_centro}}</td>
                                <td>{{$c->area}}</td>
                                <td>{{$c->gestor}}</td>
                                <td>{{$c->diretor}}</td>
                                <td><a href="{{route('editCentroCusto',['idCC'=>$c->id])}}" class="btn btn-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                                <td><button class="btn btn-link" value="{{$c->id}}|{{$c->nome_centro}}" id="excluirCC"><i class="fa fa-trash text-danger" aria-hidden="true"></i></button></td>
                              
                              </tr>
                              
                            @endforeach
                        @endisset
                      
                    </tbody>
                  </table>
            </div>
          </div>
       
    </div>

        <!-- Modal -->
<div class="modal fade" id="confirmarExclusaoCC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmar a Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form action="{{route('deleteCentroCusto')}}" method="POST">
          @csrf
          <input type="hidden" id="idCentroParaExcluir" name="idCentroCustoExcluir">
               
        Deseja Realmente realizar a exclusão do Centro de Custo <b><span id="nomeCentroCusto"></span>?</b><br><br>
        <div class="alert alert-warning">Os colaboradores que possuem este Centro de Custo serão atualizados para o Centro de Custo : <b>0000</b></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-danger" >Confirmar</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endsection