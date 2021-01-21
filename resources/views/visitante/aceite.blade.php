@extends('template.tempaceite')

@section('conteudo')
    <div class="container">
        <div class="card">
            <div class="card-header alert alert-primary">
                
            <h5>Presença Confirmada! </h5>

                    @isset($idConvite)
                   
                            @foreach ($idConvite as $id)
                            
                                    <p class="card-text"><b>Convidado por:  </b>{{$id->usuario->nome_usuario}} | {{$id->usuario->email}}</p>
                                    <p class="card-text"><b>Assunto: </b>{{$id->assunto}} | Data: {{date("d-m-Y",strtotime($id->data))}} | Hora: </b>{{date("H:i:s",strtotime($id->hora_inicio))}}</p>
                                    
                                    @if ($vaga== 1)
                                        
                                                <form method="POST" action="{{route('aceite.placa')}}" id="formPlaca">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="idConvite" value="{{$id->id}}">
                                                <input type="hidden" name="email" value="{{trim($id->email)}}">
                                                <input type="hidden" name="idempresa" value="{{$id->id_empresa}}">
                                                <input type="hidden" name="data" value="{{$id->data}}">
                                                        <div class="form-group">
                                                        <label for="exampleInputEmail1">Placa do Veículo</label>
                                                        <input type="text" class="form-control" id="placa" name="placa" aria-describedby="placa" placeholder="Placa do Veículo">
                                                        <small id="emailHelp" class="form-text text-muted">Foi liberada uma vaga de estacionamento para você</small>
                                                        </div>
                                                    
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                </form>
                                    @endif
                            @endforeach
                    
                    @endisset
                  
            </div>
            
          
    </div>
@endsection