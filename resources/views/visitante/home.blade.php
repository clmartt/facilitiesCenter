@extends('template.templayout')

@section('layout')
{{ csrf_field() }}
<div class="container">
    <div class="card">
    <h5 class="card-header">Visitantes  {{ date("d-m-Y",strtotime($dia)) ?? ''}}</h5>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                  <tr >
                   
                    <th scope="col">Convite</th>
                    <th scope="col">Data</th>
                    <th scope="col" class='text-center'>Convidados</th>
                    <th scope="col" class='text-center'>Confirmados</th>
                    <th scope="col" class='text-center'>Pendentes</th>
                  </tr>
                </thead>
                <tbody>
                  @isset($evento)
                     @foreach ($evento as $e)
                     <tr >
                     <td id="evento"><a href="" class="">{{$e->assunto}}</a></td>
                     <td>{{date('d-m-Y',strtotime($e->data))}}</td>
                     <td class='text-center'>{{$e->qtdV}}</td>
                     <td class='text-center'>{{$e->qtdC}}</td>
                     <td class='text-center'>{{$e->qtdP}}</td>
                    
                    </tr>
                     @endforeach
                  @endisset
                  
                 
                </tbody>
              </table>
             
              <div class="container" id="resultado">
                
              </div>
        </div>
      </div>

</div>
    
@endsection