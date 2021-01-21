@extends('template.tempposicoes')

@section('layout')

@isset($arrayPosicao)

@endisset
<div class="container text-center">
<figure>
    <figcaption><cite><b>KVM TÉRREO - @isset($dia)
        {{date("d-m-Y",strtotime($dia))}}
    @endisset</b></cite></figcaption>
    <img src="{{asset('img/layout/KVM_PB_PavT_Planta-Layout.gif')}}" alt="kvmterreo" width="550" height="1200" class="border border-info">
</figure>
        <div id="T1" class="posicao">1</div>

        <div id="T2" class="posicao">2</div>

        <div id="T3" class="posicao">3</div>

        <div id="T4" class="posicao">4</div>

        <div id="T5" class="posicao">5</div>

        <div id="T6" class="posicao">6</div>

        <div id="T7" class="posicao">7</div>

        <div id="T8" class="posicao">8</div>

        <div id="T9" class="posicao">9</div>

        <div id="T10" class="posicao">10</div>

        <div id="T11" class="posicao">11</div>

        <div id="T12" class="posicao">12</div>

        <div id="T13" class="posicao">13</div>

        <div id="T14" class="posicao">14</div>

        <div id="T15" class="posicao">15</div>

        <div id="T16" class="posicao">16</div>

        <div id="T17" class="posicao">17</div>

        <div id="T18" class="posicao">18</div>

        <div id="T19" class="posicao">19</div>

        <div id="T20" class="posicao">20</div>

        <div id="T21" class="posicao">21</div>

        <div id="T22" class="posicao">22</div>

        <div id="T23" class="posicao">23</div>

        <div id="T24" class="posicao">24</div>

        <div id="T25" class="posicao">25</div>

        <div id="T26" class="posicao">26</div>

        <div id="T27" class="posicao">27</div>

        <div id="T28" class="posicao">28</div>

</div>
    
@endsection