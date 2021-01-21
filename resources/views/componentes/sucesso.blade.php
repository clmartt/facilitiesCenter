<div class="alert alert-info" role="alert">
    {{$ok}} <p></p>
    @if ($posicao > 0)
    <i class="fa fa-check-circle-o text-primary" aria-hidden="true"></i> Você já possui posição agendada para este dia!
    @else
    <a href="{{route('posicoes')}}" ><i class="fa fa-street-view" aria-hidden="true"></i> Agendar Posições</a>
    @endif

  </div>