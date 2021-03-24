@extends('template.templayout')

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
                <th scope="col">Bloqueadas</th>
                <th scope="col">Reservadas</th>
                <th scope="col">Ocupadas</th>
                <th scope="col">Livres</th>
              </tr>
            </thead>
            <tbody >
              <tr class="border-bottom">
              <th scope="row"><a href="{{route('12andar',$dia)}}">12° Andar</a></th>
                <td>{{$qtdPosicaoTerreo}}</td>
                <td>{{$posicaoTerreoBloqueada}}</td>
                <td>{{$reservasTerreo}}</td>
                <td>{{$reservasCheckTerreo}}</td>
                <td>{{($qtdPosicaoTerreo-$posicaoTerreoBloqueada)-$reservasTerreo}}</td>
              </tr>
              
             
            </tbody>
          </table>


        

        
    </div>




@endsection
