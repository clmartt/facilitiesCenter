@extends('template.templayout')

@section('layout')
    <div class="container">
        <div class="card">
            @if (Session::get('ok'))
                    <div class="card-header bg-primary text-white">
                    
                        <b class="">{{Session::get('ok')}}</b>
                    </div>
            @else
                    <div class="card-header">
                        <b class="">Editar Centro de Custo</b>
                    </div>
            @endif
           
            <div class="card-body">
               
                <form method="POST" action="{{route('atualizaCentroCusto')}}" autocomplete="off">
                    @csrf
                    @foreach ($cc as $c)
                        <input type="hidden" id="idCC" name="idCC" value="{{$c->id}}">
                            <div class="form-group">
                                <label for="novoCC">Nome para Centro de Custo</label>
                                <input type="text" class="form-control" id="novoCC" name="novoCC" placeholder="Nome para o Centro de Custo" required value="{{$c->nome_centro}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="novoNumeroCC">Centro de Custo</label>
                                <input type="text" class="form-control" id="novoNumeroCC" name="centroCusto" placeholder="Informe o Centro de Custo" required value="{{$c->centroCusto}}">
                               
                            </div>
                            <div class="form-group">
                                <label for="novoCCArea">Área </label>
                                <input type="text" class="form-control" id="novoCCArea" name="novoCCArea" placeholder="Informe área do Centro de Custo" required value="{{$c->area}}">
                                
                            </div>
                            <div class="form-group">
                                <label for="novoCCGestor">Gestor </label>
                                <input type="text" class="form-control" id="novoCCGestor" name="novoCCGestor" placeholder="Informe o Gestor do Centro de Custo" value="{{$c->gestor}}" >
                                
                            </div>
                            <div class="form-group">
                                <label for="novoCCDiretor">Diretor </label>
                                <input type="text" class="form-control" id="novoCCDiretor" name="novoCCDiretor" placeholder="Informe o Diretor do Centro de Custo" value="{{$c->diretor}}">
                                
                            </div>
                    @endforeach
                 
                      <div class="text-center"><button type="submit" class="btn btn-primary">Atualizar</button></div>
                  </form>
            </div>
          </div>

    </div>



@endsection