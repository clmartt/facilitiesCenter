@extends('template.tempposicoes')

@section('layout')
@isset($nomePosicao)
    

<div class="row justify-content-md-center">
    <div class="card border border-info shadow p-3 mb-5 bg-white rounded">
    <h5 class="card-header">Posição Agendada : {{$nomePosicao}}</h5>
        <div class="card-body">
                <h5 class="card-title">{{session()->get('nome')}}</h5>
                @isset($dia)
                <p class="card-text">Para o dia : <b>{{ date("d-m-Y", strtotime($dia))}}</b></p>
                @endisset
                @if (session()->get('garagem')==1)
                    @isset($estacionamento)
                        @if ($estacionamento > 0 )
                        <p class="card-text btn btn-link" ><i class="fa fa-check-circle-o text-primary" aria-hidden="true"></i> Você já possui reserva de estacionamento para este dia!</p>
                        @else
                        <p class="card-text btn btn-link" ><a href="{{route('reservavaga',$dia)}}" class=""><i class="fa fa-car" aria-hidden="true"></i> Estacionamento</a></p>
                        @endif
                    @endisset
                   
                <p ></p>
                @endif
                
               
                
        </div>
        <div class="card-footer text-muted text-center">
            <a href="{{route('posicoes')}}" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i>  Home</a>
          </div>
      </div>
</div>
@endisset

@isset($negado)
        <div class="row justify-content-md-center">
            <div class="card border border-warning shadow p-3 mb-5 bg-white rounded">
            <h5 class="card-header alert alert-warning">Alerta!</h5>
                <div class="card-body">
                        @isset($dia)
                        <p class="card-text">Você já possui posição para o dia : <b>{{ date("d-m-Y", strtotime($dia))}}</b></p>
                        @endisset
                       
                    <a href="{{route('reservas',$dia)}}" class="btn btn-link " ><i class="fa fa-calendar" aria-hidden="true"></i> Minhas Reservas</a>
                        <p ></p>
                       
                        
                    
                        
                </div>
                <div class="card-footer text-muted text-center">
                    <a href="{{route('posicoes')}}" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i>  Home</a>
                </div>
            </div>
</div>
    
@endisset
    
@endsection