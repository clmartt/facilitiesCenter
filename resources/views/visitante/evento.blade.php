@extends('template.tempvisitante')

@section('conteudo')
    <div class="container">
        <div class="card">
            <div class="card-header alert alert-primary">
                
            <h5>Eventos {{ date("d-m-Y",strtotime($dia)) ?? ''}}</h5>
                  
            </div>
            <div class="card-body" >
                @isset($convites)
                    @foreach ($convites as $id)
                    <div class="card">
                        <div class="card-body">
                            <b>Assunto: </b>{{$id->assunto}}
                        </div>
                    </div>
                    <p class="card-title"><b>Assunto: </b>{{$id->assunto}}</p>
                    <p class="card-text"><b>Data: </b>{{date("d-m-Y",strtotime($id->data))}}</p>
                    <p class="card-text"><b>Hora: </b>{{date("H:i:s",strtotime($id->hora_inicio))}}</p>
                   
                    
                    @endforeach
                @endisset
             
              
              
            </div>
          </div>
    </div>
@endsection