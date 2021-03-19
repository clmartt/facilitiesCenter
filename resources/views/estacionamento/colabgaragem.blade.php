@extends('template.templayout')

@section('layout')
<div class="container shadow p-3 mb-5 bg-white rounded">
  
   <caption>Colaboradores </b></caption>
   
   <table class="table table-sm">
      <thead>
      <tr>
         <th scope="col">Id</th>
         <th scope="col">Nome</th>
         <th scope="col">Email</th>
         <th scope="col">Elegível</th>
         
         
      </tr>
      </thead>
      <tbody>
         @foreach ($colab as $c)
        
            
         <tr>
                 
         <td>{{$c['idusuario']}}</td>
         <td>{{$c['nome_usuario']}}</td>
         <td>{{$c['email']}}</td>
         @if ($c['garagem']==1)
         <td ><a href="/elegivel/{{$c['idusuario']}}" class="fa fa-car btn btn-outline-success"><i  aria-hidden="true"></i></a></td>
         @else
         <td ><a href="/elegivel/{{$c['idusuario']}}" class="fa fa-car btn btn-outline-danger"><i aria-hidden="true"></i></a></td>
         @endif

         @endforeach

      


      </tbody>
   </table>
</div>
@endsection