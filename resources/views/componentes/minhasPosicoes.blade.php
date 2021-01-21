 
   
<div class="container shadow p-3 mb-5 bg-white rounded">
   @isset($dia)
   <caption>Reservas de Posições para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
   @endisset
   <table class="table table-sm">
      <thead>
      <tr>
         <th scope="col">Posicao</th>
         <th scope="col">Data</th>
         <th scope="col">Cancelar</th>
         
         
      </tr>
      </thead>
      <tbody>
         @foreach ($minhasReservas as $item)
        
            
         <tr>
            <td scope="row"><i class="fa fa-user" aria-hidden="true"></i> {{  $item['nome_posicao']   }}</th>
         
         <td>{{ date('d-m-Y',strtotime($item['data_reserva']))}}</td>
         <td ><form action="{{route('cancelar',$item['idreservas']."/".$layout)}}" method="POST"> @csrf @method('DELETE') 
            <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></button></form></td>
         
         </tr>

         @endforeach

      


      </tbody>
   </table>
</div>



