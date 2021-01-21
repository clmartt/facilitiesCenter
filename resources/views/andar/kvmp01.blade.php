@extends('template.tempposicoes')

@section('layout')

<div class="container text-center">
<figure>
    <figcaption><cite><b>KVM TÉRREO - @isset($dia)
        {{date("d-m-Y",strtotime($dia))}}
    @endisset</b></cite></figcaption>
    <img src="{{asset('img/layout/KVM_PB_Pav01_Planta-Layout.gif')}}" alt="kvmterreo" width="550" height="1200" class="border border-info">
</figure>

<div id="P1" class="posicao">1</div>
<div id="P2" class="posicao">2</div>
<div id="P3" class="posicao">3</div>
<div id="P4" class="posicao">4</div>
<div id="P5" class="posicao">5</div>
<div id="P6" class="posicao">6</div>
<div id="P7" class="posicao">7</div>
<div id="P8" class="posicao">8</div>
<div id="P9" class="posicao">9</div>
<div id="P10" class="posicao">10</div>
<div id="P11" class="posicao">11</div>
<div id="P12" class="posicao">12</div>
<div id="P13" class="posicao">13</div>
<div id="P14" class="posicao">14</div>
<div id="P15" class="posicao">15</div>
<div id="P16" class="posicao">16</div>
<div id="Preuniao01" class="sala"><a href="{{route('calendar','reuniao1@kvminformatica.com.br'.'/'.$dia)}}" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
<div id="Preuniao02" class="sala"><a href="{{route('calendar','reuniao2@kvminformatica.com.br'.'/'.$dia)}}" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
<div id="Ptreinamento" class="sala"><a href="#" class="btn btn-success"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
</div>
    
@endsection