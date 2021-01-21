@extends('template.tempposicoes')

@section('layout')
                    @isset($nomePosicao)
                        <div class="row justify-content-md-center">
                        <div class="card border border-info shadow p-3 mb-5 bg-white rounded">
                        <h5 class="card-header">Posição Bloqueada : {{$nomePosicao}}</h5>
                            <div class="card-body">
                                    <h5 class="card-title"> Bloqueado por {{session()->get('nome')}}</h5>
                                    @isset($dia)
                                    <p class="card-text">Dia : <b>{{ date("d-m-Y", strtotime($dia))}}</b></p>
                                    @endisset
                                            
                                
                                    
                            </div>
                            <div class="card-footer text-muted text-center">
                                <a href="{{route('posicoes')}}" class="btn btn-primary"><i class="fa fa-home" aria-hidden="true"></i>  Home</a>
                            </div>
                        </div>
                    </div>
                    @endisset
@endsection


