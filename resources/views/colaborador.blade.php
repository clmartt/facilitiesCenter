@extends('template.templayout')

@section('layout')

@if (session()->get('posicao')=='sim')
        @isset($colabs)

        <div class="container">
          @isset($dia)
              <caption>Reservas para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
          @endisset
          <table class="table table-sm shadow p-3 mb-5 bg-white rounded">
              <thead>
                <tr>
                  <th scope="col">Andar</th>
                  <th scope="col">Posição</th>
                  <th scope="col">Colaborador</th>
                  <th scope="col">Check</th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ($colabs as $item)

                  <tr>
                  <td>{{$item->andar}}</td>
                  <td>{{$item->nome_posicao}}</td>
                  <td scope="row">{{$item->usuario->nome_usuario}}</td>
                  <td>{{$item->checado}}</td>
                
                </tr>

                  @endforeach

                


              </tbody>
            </table>
        </div>

        @endisset
@endif


<p></p>
@if (session()->get('estacionamento')=='sim')
    @isset($minhasVagas)
        @component('componentes.minhasVagas',['dia'=>$dia,'minhasVagas'=>$minhasVagas])
                    
        @endcomponent

    @endisset
@endif



<p></p>
@if (session()->get('salas')=='sim')
    @isset($minhasSalas)
        @component('componentes.minhasSalas',['dia'=>$dia,'minhasSalas'=>$minhasSalas])
                    
        @endcomponent

    @endisset
@endif

   
@endsection