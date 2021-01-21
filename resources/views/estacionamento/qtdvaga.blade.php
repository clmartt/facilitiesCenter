@extends('template.tempgaragem')

@section('conteudo')
   <div class="container justify-content-md-center "> 
      @isset($dia)
            <caption>Estacionamento para : <b>{{date("d-m-Y",strtotime($dia))}}</b></caption>
       @endisset
      <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
                  <table class="table table-hover">
                     <thead>
                     <tr class="text-center">
                        <th scope="col">Qtd</th>
                        <th scope="col"><i class="fa fa-car btn btn-danger" aria-hidden="true"></i> </th>
                        <th scope="col"><i class="fa fa-car btn btn-success" aria-hidden="true"></i></th>
                        
                     </tr>
                     </thead>
                     <tbody>
                     <tr class="text-center">
                     <th scope="row"><a href="#" id="qtd">{{$qtd ?? ''}}</a></th>
                        <td>{{$ocupada ?? ''}}</td>
                        <td>{{$disponivel ?? ''}}</td>
                        
                     </tr>
                    
                     </tbody>

                     
                  </table>

                  <div class="row justify-content-md-center " id="alterarqtd"> 
                     <div class="card text-center shadow p-3 mb-5 bg-white rounded" style="width: 20rem">
                        <div class="card-header">
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          <p class="card-text">Nova Quantidade </p>
                          
                        </div>
                        <div class="card-body ">
                        
                        <form method="POST" action={{route('upVaga')}}>
                           
                           @csrf
                              <div class="form-row">
                               
                                <div class="col">
                                  <input type="text" class="form-control" placeholder="QTD" name="qtd" required>
                                </div>
                                <div class="col">
                                 <button type="submit" class="btn btn-info">Salvar</button>
                                </div>
                              </div>
                        </form>
                   </div>
      </div>

      

      

   </div>
@endsection