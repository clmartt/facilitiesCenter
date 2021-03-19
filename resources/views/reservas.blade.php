@extends('template.templayout')

@section('layout')
      @if (session()->get('posicao')=='sim')
            @isset($minhasReservas)
      
      
            @component('componentes.minhasPosicoes',['dia'=>$dia,'minhasReservas'=>$minhasReservas,'layout'=>$layout])
            
            @endcomponent
      
            @endisset
      @endif
 

   <p ></p>
  
   @if (session()->get('estacionamento')=='sim')
            @isset($minhasVagas)
            <p ></p>
                  @component('componentes.minhasVagas',['dia'=>$dia,'minhasVagas'=>$minhasVagas,'layout'=>$layout])
                        
                  @endcomponent
            @endisset
   @endif
   

      @if (session()->get('salas')=='sim')
            @isset($minhasSalas)
            <p ></p>
                  @component('componentes.minhasSalas',['dia'=>$dia,'minhasSalas'=>$minhasSalas,'layout'=>$layout])
                  
                  @endcomponent
            @endisset
      @endif
   


   <p ></p>
@endsection