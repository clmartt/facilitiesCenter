@extends('template.tempgaragem')

@section('conteudo')
   <div class="row justify-content-md-center "> 
      <div class="card text-center shadow p-3 mb-5 bg-white rounded" style="width: 50rem">
         <div class="card-header">
           <h4>Reserva de Vaga</h4>
         </div>
         <div class="card-body ">
         
         <form method="POST" action="{{route('salvarVaga')}}">
            @csrf
           
               <div class="form-row">
                 <div class="col-4">
                 <input type="date" class="form-control" name="dataReserva" required value="{{ $dia ?? ''}}">
                 </div>
                 <div class="col">
                   <input type="text" class="form-control" placeholder="Placa do Veículo" name="placa" required>
                 </div>
                 <div class="col-1">
                  <button type="submit" class="btn btn-info">Salvar</button>
                 </div>
               </div>
         </form>
    </div>
         <div class="card-footer text-muted">
            @isset($ok)
              
               @component('componentes.sucesso',['ok'=>$ok,'posicao'=>$posicao]);
               @endcomponent               
           @endisset
           @isset($error)
               @component('componentes.erro',['error'=>$error]);
               @endcomponent               
           @endisset
         </div>
       </div>
   </div>
@endsection