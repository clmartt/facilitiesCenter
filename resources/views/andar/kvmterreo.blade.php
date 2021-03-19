@extends('template.templayout')

@section('layout')

@isset($arrayPosicao)

@endisset
<div class="container text-center" id="principal">
<figure>
    <figcaption><cite><b>BV 12° ANDAR- @isset($dia)
        {{date("d-m-Y",strtotime($dia))}}
    @endisset</b></cite></figcaption>
    <img src="{{asset('img/layout/andar12.jpg')}}" alt="kvmterreo" width="1000" height="550" class="border border-info" style="margin-left: 16px">
</figure>

@foreach ($allPosicao as $ap)
    
      @if (session()->get('perfil')=='adm')
      <div id="{{$ap->nome_posicao}}" title="{{$ap->nome_posicao}}" class="posicao text-center" style="background-color:{{$ap->cor_grupo ?? 'green'}}"><p id="txtP" class="text-center" >{{$ap->nick}}</p></div> 
        
      @else
        @if (session()->get('idGrupo')==$ap->id_grupo)
        <div id="{{$ap->nome_posicao}}" title="{{$ap->nome_posicao}}" class="posicao text-center" style="background-color:{{$ap->cor_grupo ?? 'green'}}"><p id="txtP" class="text-center"  >{{$ap->nick}}</p></div>  
        @else
        <div id="{{$ap->nome_posicao}}" title="{{$ap->nome_posicao}}" class="posicaoDisabled text-center" style="background-color:{{$ap->cor_grupo ?? 'green'}}"><p id="txtP" class="text-center">{{$ap->nick}}</p></div> 
        @endif
      @endif

    
         
         
        

        
@endforeach

</div>

@endsection

@component('componente.modal',['grupos'=>$grupos])
    
@endcomponent