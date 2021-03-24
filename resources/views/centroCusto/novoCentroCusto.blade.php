@extends('template.templayout')

@section('layout')
    <div class="container">
        <div class="card">
            @if (Session::get('salvo'))
                    <div class="card-header bg-primary text-white">
                    
                        <b class="">{{Session::get('salvo')}}</b>
                    </div>
            @else
                    <div class="card-header">
                        <b class="">Novo Centro de Custo</b>
                    </div>
            @endif
           
            <div class="card-body">
               
                <form method="POST" action="{{route('salvaNovoCentroCusto')}}">
                    @csrf
                    <div class="form-group">
                      <label for="novoCC">Nome para Centro de Custo</label>
                      <input type="text" class="form-control" id="novoCC" name="novoCC" placeholder="Nome para o Centro de Custo" required>
                      
                    </div>
                    <div class="form-group">
                      <label for="novoNumeroCC">Centro de Custo</label>
                      <input type="text" class="form-control" id="novoNumeroCC" name="centroCusto" placeholder="Informe o Centro de Custo" required>
                      @if ($errors->any())
                            @foreach ($errors->all() as $e)
                                <div class="alert alert-danger">{{$e}}</div>
                            @endforeach
                      @endif 
                    </div>
                    <div class="form-group">
                        <label for="novoCCArea">Área </label>
                        <input type="text" class="form-control" id="novoCCArea" name="novoCCArea" placeholder="Informe área do Centro de Custo" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="novoCCGestor">Gestor </label>
                        <input type="text" class="form-control" id="novoCCGestor" name="novoCCGestor" placeholder="Informe o Gestor do Centro de Custo" >
                        
                    </div>
                    <div class="form-group">
                        <label for="novoCCDiretor">Diretor </label>
                        <input type="text" class="form-control" id="novoCCDiretor" name="novoCCDiretor" placeholder="Informe o Diretor do Centro de Custo" >
                        
                    </div>
                      <div class="text-center"><button type="submit" class="btn btn-primary">Salvar</button></div>
                  </form>
            </div>
          </div>

    </div>
@endsection