<div class="container shadow p-3 mb-5 bg-white rounded">
    @isset($dia)
    <caption>Reservas de Salas para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
    @endisset
    <table class="table table-sm">
       <thead>
       <tr>
          <th scope="col">Sala</th>
          <th scope="col">Data</th>
          <th scope="col">Inicio</th>
          <th scope="col">Fim</th>
          <th scope="col">Assunto</th>
          <th scope="col">Organizador</th>
          
          
       </tr>
       </thead>
       <tbody>
          @foreach ($minhasSalas as $sala)

          <tr>
          <td >{{$sala->sala}}</td>
            <td >{{ date('d-m-Y', strtotime($sala->data_inicio))}}</td>
            <td >{{$sala->hora_inicio}}</td>
            <td >{{$sala->hora_fim}}</td>
            <td >{{$sala->assunto}}</td>
            @if ($sala->usuario->nome_usuario)
                <td >{{$sala->usuario->nome_usuario}}</td>
            @endif
            
          
          </tr>

          @endforeach

       


       </tbody>
    </table>
 </div>
