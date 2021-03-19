@extends('template.templayout')

@section('layout')

<div class="container text-center">
<figure>
    <figcaption><cite><b>KVM TÉRREO - @isset($dia)
        {{date("d-m-Y",strtotime($dia))}}
    @endisset</b></cite></figcaption>
    <img src="{{asset('img/layout/KVM_PB_Pav01_Planta-Layout.gif')}}" alt="kvmterreo" width="550" height="1200" class="border border-info" style="margin-left: 16px">
</figure>

        @foreach ($allPosicao as $ap)
            
            @if (session()->get('perfil')=='adm')
            <div id="{{$ap->nome_posicao}}" class="posicao" style="background-color:{{$ap->cor_grupo ?? 'green'}}">{{$ap->nome_posicao}}</div> 
                
            @else
                @if (session()->get('idGrupo')==$ap->id_grupo)
                <div id="{{$ap->nome_posicao}}" class="posicao" style="background-color:{{$ap->cor_grupo ?? 'green'}}">{{$ap->nome_posicao}}</div>  
                @else
                <div id="{{$ap->nome_posicao}}" class="posicaoDisabled" style="background-color:{{$ap->cor_grupo ?? 'green'}}">{{$ap->nome_posicao}}</div> 
                @endif
            @endif

            
                
                
                

                
        @endforeach





<div id="Preuniao01" class="sala"><a href="{{route('calendar','reuniao1@kvminformatica.com.br'.'/'.$dia)}}" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
<div id="Preuniao02" class="sala"><a href="{{route('calendar','reuniao2@kvminformatica.com.br'.'/'.$dia)}}" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
<div id="Ptreinamento" class="sala"><a href="#" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
</div>
    
@endsection

@component('componente.modal',['grupos'=>$grupos])
    
@endcomponent