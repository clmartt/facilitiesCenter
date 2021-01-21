<div class="container shadow p-3 mb-5 bg-white rounded">
    @isset($dia)
    <caption>Reservas de Vagas para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
    @endisset
    <table class="table table-sm">
       <thead>
       <tr>
          <th scope="col">Placa</th>
          <th scope="col">Data</th>
          <th scope="col">Colaborador</th>
          @isset($layout)
               <th scope="col">Cancelar</th
          @endisset
       
         
          
          
       </tr>
       </thead>
       <tbody>
          @foreach ($minhasVagas as $vaga)

          <tr>
            
            <td >{{$vaga->placa}}</td>
            <td >{{date('d-m-Y',strtotime($vaga->data_reserva)) }}</td>
            <td>{{$vaga->colaborador}}</td>
         @isset($layout)
         <td ><form action="{{route('cancelarVaga',$vaga['id']."/".$layout)}}" method="POST"> @csrf @method('DELETE') 
            <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></button></form></td>
         @endisset
                       
          </tr>

          @endforeach

       


       </tbody>
    </table>
 </div>
