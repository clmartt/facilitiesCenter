@extends('template.tempmodulo')

@section('conteudo')
    

   <div class="container" >
    <div class="card-deck">
        @if (session()->get('posicao')=="sim")
              <div class="card shadow p-3 mb-5 bg-white rounded" >
                <img class="card-img-top rounded" src="{{asset('img/modulos/escritorio.svg')}}" alt="Card image cap" height="180">
                  <div class="card-body">
                    <h5 class="card-title">Gestão de Posições</h5>
                    <p class="card-text">Controle de posições e monitoramento de ocupação</p>
                  </div>
                  <div class="card-footer text-center">
                  <small class="text-muted"><a href="{{route("posicoes")}}" class="btn btn-info">Acessar</a></small>
                  </div>
                </div>
        @endif

        @if (session()->get("estacionamento") == "sim")
              <div class="card shadow p-3 mb-5 bg-white rounded ">
                <img class="card-img-top" src="{{asset('img/modulos/car2.svg')}}" alt="Card image cap" height="180">
                <div class="card-body">
                  <h5 class="card-title">Gestão de Estacionamento</h5>
                  <p class="card-text">Faça a reserva da sua posição no Estacionamento</p>
                </div>
                <div class="card-footer text-center">
                  <small class="text-muted"><a href="{{route("garagem")}}" class="btn btn-info">Acessar</a></small>
                </div>
              </div>
        @endif
        


        
        @if (session()->get('salas')== "sim")
              <div class="card shadow p-3 mb-5 bg-white rounded">
                <img class="card-img-top" src="{{asset('img/modulos/salas.svg')}}" alt="Card image cap" height="180">
                <div class="card-body">
                  <h5 class="card-title">Gestão de Sala</h5>
                  <p class="card-text">Agendamento de Sala de Reunião</p>
                </div>
                <div class="card-footer text-center">
                  <small class="text-center"><a href="{{route("kvmp01")}}" class="btn btn-info">Acessar</a></small>
                </div>
              </div>
        @endif

      
        @if (session()->get('visitantes')== "sim")
              <div class="card shadow p-3 mb-5 bg-white rounded">
                <img class="card-img-top" src="{{asset('img/modulos/visitantes.png')}}" alt="Card image cap" height="180">
                <div class="card-body">
                  <h5 class="card-title">Gestão de Visitantes</h5>
                  <p class="card-text">Controle e acesso facilitado aos visitantes</p>
                </div>
                <div class="card-footer text-center">
                  <small class="text-center"><a href="{{route("visitante")}}" class="btn btn-info">Acessar</a></small>
                </div>
              </div>
    </div>
 
        @endif

        
   
   
   </div>
@endsection