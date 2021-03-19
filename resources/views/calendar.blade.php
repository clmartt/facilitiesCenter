<!-- Copyright (c) Microsoft Corporation.
     Licensed under the MIT License. -->

<!-- <CalendarSnippet> -->
  @extends('template.templayout')

  @section('layout')
  
  <h2></h2>
  <div class="container">
    
    <caption><h3>Calendario</h3></caption>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Sala</th>
                        <th scope="col">Data</th>
                        <th scope="col">Horario</th>
                        <th scope="col">Agendar</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                    
                      @isset($valores)
                    
                      
                    
                      @foreach( $valores['meetingTimeSuggestions'] as $val)
                    <tr> <td> {{ $val['attendeeAvailability'][0]['attendee']['emailAddress']['address']}}</td>
                      <td>{{date('d-m-Y',strtotime($val['meetingTimeSlot']['start']['dateTime']))}}</td>
                      <td>{{ date('H:i:s', strtotime($val['meetingTimeSlot']['start']['dateTime']))." as ". date('H:i:s',strtotime($val['meetingTimeSlot']['end']['dateTime']))}}</td>
                      <td><a class="btn btn-info btn-sm mb-3" href={{'/calendar/new/'.$val['attendeeAvailability'][0]['attendee']['emailAddress']['address'].'/'.date('Y-m-d\TH:i:s',strtotime($val['meetingTimeSlot']['start']['dateTime'])).'/'.date('Y-m-d\TH:i:s',strtotime($val['meetingTimeSlot']['end']['dateTime']))}}>Agendar</a></td></tr>  
                      
                      @endforeach

                        
                      @endif
                    </tbody>
                  </table>
  </div>
  @endsection
  <!-- </CalendarSnippet> -->