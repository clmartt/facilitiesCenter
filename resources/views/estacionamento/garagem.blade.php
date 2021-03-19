@extends('template.templayout')

@section('layout')
    @isset($reservas)
    <div class="container">
        @isset($dia)
    <caption>Reservas de Vagas para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
    @endisset
    <table class="table table-sm">
       <thead>
       <tr>
          <th scope="col">Data</th>
          <th scope="col">Placa</th>
          <th scope="col">Colaborador</th>
          @if(session()->get('perfil') == 'adm')
          <th scope="col">Cancelar</th>
          @endif
         
         
          
          
       </tr>
       </thead>
       <tbody>
          @foreach ($reservas as $vaga)

          <tr>
            <td >{{date("d-m-Y",strtotime($vaga->data_reserva)) }}</td>
            <td >{{$vaga->placa}}</td>
            <td >{{$vaga->colaborador}}</td>
            @if (session()->get('perfil') == 'adm')
                 <td ><form action="{{route('cancelarVaga',$vaga['id']."/"."garagem")}}" method="POST"> @csrf @method('DELETE') 
               <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></button></form></td>
            @endif
           
           
          </tr>

          @endforeach

       


       </tbody>
    </table>
    </div>
        
    @endisset
@endsection