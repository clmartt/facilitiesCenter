<!-- Copyright (c) Microsoft Corporation.
     Licensed under the MIT License. -->

<!-- <NewEventFormSnippet> -->
@extends('template.templayout')

@section('layout')

@empty($horaInicio)
{{$horaInicio=""}}
{{$horaFim=""}}
    
@endempty
<div class="container shadow p-3 mb-5 bg-white rounded" >
<h3>Novo evento</h3>
<form method="POST" action="/calendar/new">
  @csrf
  <input type="hidden" value="{{$sala ?? ''}}" name="nomesala">
  <div class="form-group">
    <label>Assunto</label>
  <input type="text" class="form-control" name="eventSubject"  />
  </div>
  <div class="form-group">
    <label>Participantes</label>
  <input type="text" class="form-control" name="eventAttendees" value="{{$sala.";" ?? ''}}"/>
  </div>
  <div class="form-row">
    <div class="col">
      <div class="form-group">
        <label>Inicio</label>
      <input type="datetime-local" class="form-control" name="eventStart" id="eventStart" value="{{$horaInicio}}" readonly/>
      </div>
      @error('eventStart')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="col">
      <div class="form-group">
        <label>Fim</label>
        <input type="datetime-local" class="form-control" name="eventEnd" value="{{$horaFim}}" readonly/>
      </div>
      @error('eventEnd')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="form-group">
    <label>Corpo da Mensagem</label>
    <textarea type="text" class="form-control" name="eventBody" rows="3"></textarea>
  </div>
  @isset($agendado)
  <div class="alert alert-primary text-center" role="alert">
    Agendamento realizado !
  </div>
      
  @endisset
  <div class="text-center">
        <input type="submit" class="btn btn-primary mr-2" value="Criar" />
        <a class="btn btn-secondary" href={{ url()->previous() }}>Cancelar</a>
  </div>
</form>
</div>
@endsection
<!-- </NewEventFormSnippet> -->