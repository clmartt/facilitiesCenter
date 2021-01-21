@extends('template.tempposicoes')

@section('layout')

<div class="container">
  @isset($dia)
  <caption>Reservas para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
  @endisset
        <table class="table table-borderless table-hover text-center border-bottom shadow p-3 mb-5 bg-white rounded ">
          
            <thead>
              <tr class="table-primary">
                <th scope="col">Andar</th>
                <th scope="col">Qtd Posições</th>
                <th scope="col">Ocupadas</th>
                <th scope="col">Livres</th>
              </tr>
            </thead>
            <tbody >
              <tr class="border-bottom">
              <th scope="row"><a href="{{route('kvmterreo',$dia)}}">TERREO</a></th>
                <td>{{$qtdPosicaoTerreo}}</td>
                <td>{{$reservasTerreo}}</td>
                <td>{{$qtdPosicaoTerreo-$reservasTerreo}}</td>
              </tr>
              
              <tr class="border-bottom">
              <th scope="row"><a href="{{route('kvmp01',$dia)}}">PAV01</a></th>
                <td>{{$qtdPosicaoP1}}</td>
                <td>{{$reservasP1}}</td>
                <td>{{$qtdPosicaoP1-$reservasP1}}</td>
              </tr>
              <tr class="border-bottom">
              <th scope="row"><a href="{{route('kvmsub',$dia)}}">PB_SUB</a></th>
              <td>{{$qtdPosicaoSub}}</td>
                <td>{{$reservasSub}}</td>
                <td>{{$qtdPosicaoSub-$reservasSub}}</td>
              </tr>
            </tbody>
          </table>


        

        
    </div>




@endsection
