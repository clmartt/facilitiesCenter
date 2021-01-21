<?php
// Copyright (c) Microsoft Corporation.
// Licensed under the MIT License.

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use App\TimeZones\TimeZones;
use App\ReservaSala;
use App\Reserva;
use App\VagaReserva;
use App\Convite;

use function GuzzleHttp\json_decode;
use function GuzzleHttp\json_encode;

class CalendarController extends Controller
{ /**
   * @SuppressWarnings(PHPMD.StaticAccess)
   */
  public function calendar(Request $request)
  {
   
   if($request->dia == ''){
     $dia = date('Y-m-d');
   }else{
    $dia = $request->dia;
   }
    $viewData = $this->loadViewData();

    $graph = $this->getGraph();

    // Get user's timezone
    $timezone = TimeZones::getTzFromWindows($viewData['userTimeZone']);

    // Get start and end of week
    $startOfWeek = new \DateTimeImmutable('sunday -1 week', $timezone);
    $endOfWeek = new \DateTimeImmutable('sunday', $timezone);

    $viewData['dateRange'] = $startOfWeek->format('M j, Y').' - '.$endOfWeek->format('M j, Y');

    $queryParams = array(
     'startDateTime' => $startOfWeek->format(\DateTimeInterface::ISO8601),
      'endDateTime' => $endOfWeek->format(\DateTimeInterface::ISO8601),
      // Only request the properties used by the app
      '$select' => 'subject,organizer,start,end',
      // Sort them by start time
      '$orderby' => 'start/dateTime',
      // Limit results to 25
      '$top' => 25
    );

    $bodyjson = '{
      "attendees": [
          {
              "emailAddress": {
                  "address": "'.$request->sala.'",
                  "name": "'.$request->sala.'"
              },
              "type": "Required"
          }
      ],
      "timeConstraint": {
          "timeslots": [
              {
                  "start": {
                      "dateTime": "'.$dia.'T08:00:52",
                      "timeZone": "'.$viewData['userTimeZone'].'",
                  },
                  "end": {
                      "dateTime": "'.$dia.'T19:00:52",
                      "timeZone": "'.$viewData['userTimeZone'].'",
                  }
              }
          ]
      },
      "locationConstraint": {
          "isRequired": "false",
          "suggestLocation": "true",
          "locations": [
              {
                  "displayName": "Conf Room 32/1368",
                  "locationEmailAddress": "conf32room1368@imgeek.onmicrosoft.com"
              }
          ]
      },
      "meetingDuration": "PT1H"
  }';

 
    
    
    // Append query parameters to the '/me/calendarView' url
    $getEventsUrl = '/me/findMeetingTimes';
    //$getEventsUrl = '/users/reuniao1@kvminformatica.com.br/calendarView?'.http_build_query($queryParams);
    $events = $graph->createRequest('POST', $getEventsUrl)->attachBody($bodyjson)
      // Add the user's timezone to the Prefer header
      ->addHeaders(array(
        'Prefer' => 'outlook.timezone="'.$viewData['userTimeZone'].'"'
        
      ))
      ->setReturnType(Model\Event::class)
      ->execute();

      $viewData['events'] = $events;
      //return view('calendar', $viewData);
      $jsonObjt = json_encode($events);
      $jsonString = json_decode($jsonObjt,true);
      array_shift($jsonString);
     
        //return view('calendar')->with(compact('valores',$jsonString));
        return view('calendar')->with('valores',$jsonString)->with('sala',$request->sala);
  
         
                 
  }
 
  // <getNewEventFormSnippet>
  public function getNewEventForm()
  {

    return view('newevent');
  }
  
  public function createNewEvent(Request $request)
  {
    // Validate required fields
    $request->validate([
      'eventSubject' => 'nullable|string',
      'eventAttendees' => 'nullable|string',
      'eventStart' => 'required|date',
      'eventEnd' => 'required|date',
      'eventBody' => 'nullable|string'
    ]);

    $viewData = $this->loadViewData();

    $graph = $this->getGraph();

    // Attendees from form are a semi-colon delimited list of
    // email addresses
    $attendeeAddresses = explode(';', $request->eventAttendees);

    // The Attendee object in Graph is complex, so build the structure
    $attendees = [];
    foreach($attendeeAddresses as $attendeeAddress)
    {
      array_push($attendees, [
        // Add the email address in the emailAddress property
        'emailAddress' => [
          'address' => $attendeeAddress
        ],
        // Set the attendee type to required
        'type' => 'required'
      ]);
    }

    // Build the event
    $newEvent = [
      'subject' => $request->eventSubject,
      'attendees' => $attendees,
      'start' => [
        'dateTime' => $request->eventStart,
        'timeZone' => $viewData['userTimeZone']
      ],
      'end' => [
        'dateTime' => $request->eventEnd,
        'timeZone' => $viewData['userTimeZone']
      ],
      'body' => [
        'content' => $request->eventBody,
        'contentType' => 'text'
      ]
    ];

    // POST /me/events
    $response = $graph->createRequest('POST', '/me/events')
      ->attachBody($newEvent)
      ->setReturnType(Model\Event::class)

      
      ->execute();

      $novaReserva = new ReservaSala();
      $novaReserva->id_user = session()->get('idusuario');
      $novaReserva->id_empresa = session()->get('idempresa');
      $novaReserva->sala = $request->nomesala;
      $novaReserva->assunto = $request->eventSubject;
      $novaReserva->data_inicio = $request->eventStart;
      $novaReserva->hora_inicio = $request->eventStart;
      $novaReserva->data_fim = $request->eventEnd;
      $novaReserva->hora_fim = $request->eventEnd;
      $novaReserva->participantes = $request->eventAttendees;
      $novaReserva->save();

      // pegando as reservas das posições e vagas
      $idusuario = session()->get('idusuario');
      $idempresa = session()->get('idempresa');
      $data = date("Y-m-d",strtotime($request->eventStart));
      $posicao = Reserva::where('usuario_idusuario',$idusuario)->where('empresa_idempresa',$idempresa)->where('data_reserva',$data)->count();
      $estacionamento = VagaReserva::where('id_usuario',$idusuario)->where('id_empresa',$idempresa)->where('data_reserva',$data)->count();
      
      
      return view('confirm.confirmsala')->with('agendado',"Sala Agendada!")->with('posicao',$posicao)->with('estacionamento',$estacionamento)->with('dia',$data);
  }
  // </createNewEventSnippet>

  private function getGraph(): Graph
  {
    // Get the access token from the cache
    $tokenCache = new TokenCache();
    $accessToken = $tokenCache->getAccessToken();

    // Create a Graph client
    $graph = new Graph();
    $graph->setAccessToken($accessToken);
    return $graph;
  }







  




}