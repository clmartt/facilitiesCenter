@extends('template.tempposicoes')

@section('layout')

   @isset($minhasReservas)
   
   
            @component('componentes.minhasPosicoes',['dia'=>$dia,'minhasReservas'=>$minhasReservas,'layout'=>$layout])
                
            @endcomponent
         
   @endisset

   <p ></p>
  
   @isset($minhasVagas)
   <p ></p>
         @component('componentes.minhasVagas',['dia'=>$dia,'minhasVagas'=>$minhasVagas,'layout'=>$layout])
             
         @endcomponent
   @endisset


   @isset($minhasSalas)
   <p ></p>
         @component('componentes.minhasSalas',['dia'=>$dia,'minhasSalas'=>$minhasSalas,'layout'=>$layout])
             
         @endcomponent
   @endisset


   <p ></p>
@endsection