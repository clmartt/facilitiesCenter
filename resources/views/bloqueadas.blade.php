@extends('template.tempposicoes')

@section('layout')
  @isset($bloqueadas)
            <div class="container">
               <table class="table table-sm">
                  <thead>
                  <tr>
                     <th scope="col">Posicao</th>
                     <th scope="col">Andar</th>
                     <th scope="col">Finalidade</th>
                     <th scope="col">Para</th>
                     <th scope="col">Liberar</th>
                     
                     
                  </tr>
                  </thead>
                  <tbody>
                     @foreach ($bloqueadas as $b)
                     <tr>
                    
                     <td>{{$b['nome_posicao']}}</td>
                     <td>{{$b['andar']}}</td>
                     <td>{{$b['finalidade']}}</td>
                     <td>{{$b['bloqueio_para']}}</td>
                     <td><a href=" {{route('desbloqueio',$b['nome_posicao'])}}" class="btn btn-outline-warning">Desbloquear</a></td>
                     </tr>

                     @endforeach
             


                  </tbody>
               </table>
            </div>
  @endisset
@endsection