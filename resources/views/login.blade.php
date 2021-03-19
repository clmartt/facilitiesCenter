<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('temp/fonts/icomoon/style.css')}}">

    <link rel="stylesheet" href="{{asset('temp/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('temp/css/bootstrap.min.css')}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('temp/css/style.css')}}">

    <title>LOGIN </title>
  </head>
  <body>
  

  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="{{asset('temp/images/pws.jpg')}}" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <img src="{{asset('img/logoL.jpg')}}" alt="">
              <p class="mb-4">Gerencie Posições de trabalho, estacionamento e muito mais!!!</p>
            </div>
            <form method="POST" action="{{route('modulos')}}">
              @csrf
              <div class="form-group first">
                <label for="username">Email</label>
                <input type="text" class="form-control"  id="email" name="email">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Senha</label>
                <input type="password" class="form-control"  id="senha" name="senha">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
             
                <span class="ml-auto"><a href="#" class="forgot-pass">Esqueci a senha</a></span> 
              </div>

              <input type="submit" value="Entrar" class="btn text-white btn-block btn-primary">

       
            </form>
            @isset($erro)
                <div class="alert alert-danger" role="alert">
                  {{$erro}}
                </div>
            @endisset
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="{{asset('temp/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('temp/js/popper.min.js')}}"></script>
    <script src="{{asset('temp/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('temp/js/main.js')}}"></script>
  </body>
</html>