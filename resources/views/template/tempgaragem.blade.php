<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/icone/css/font-awesome.min.css")}}">
    <title>Gestao de Estacionamento</title>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script>
      $(function(){
        $('#alterarqtd').hide();

        $("#qtd").click(function(){
          $('#alterarqtd').fadeIn('slow');
        })

        $('#close').click(function(){
          $('#alterarqtd').fadeOut('slow');
        })
      })
    </script>





  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow p-3 mb-5 bg-white rounded">
       
        <a class="navbar-brand"  href="{{route('backmodulo')}}">
          <i class="fa fa-car text-primary" aria-hidden="true"></i>
                Power Service
            </a>
       
            
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-item nav-link active" href="{{route('garagem')}}"> <i class="fa fa-home" aria-hidden="true"></i> Home</a>
            <a class="nav-item nav-link active" href="{{route('minhasreservas')}}"> <i class="fa fa-calendar" aria-hidden="true"></i> Minhas reservas</a>
            <a class="nav-item nav-link active" href="{{route('reservavaga')}}"> <i class="fa fa-id-card-o" aria-hidden="true"></i> Reservar vaga</a>
              @if (session()->get('perfil')== 'adm')
                    <a class="nav-item nav-link active" href="{{route('qtdvaga')}}"> <i class="fa fa-car" aria-hidden="true"></i> Nº de Vagas : </a>
                    <a class="nav-item nav-link active" href="{{route('colabgaragem')}}"> <i class="fa fa-user-circle" aria-hidden="true"></i> Colaboradores</a>
              @endif
           
           
           
            <form class="form-inline" method="GET" action="{{"/".$route = Route::current()->getName()}}" style="margin-left:30px">
              @csrf
                <input type="hidden" value="{{$sala ?? ''}}" name="sala"> 
                <input class="form-control mr-sm-2 border border-primary" type="date" name="dia">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
             </form>
          
            </div>
        </div>
        <form class="form-inline">
           @component('componentes.botaoUser')
               
           @endcomponent
        </form>
    </nav>
        @yield('conteudo')





    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
   <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
 
 
  </body>
</html>