<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>QR_LOGIN</title>
  </head>
  <body>
    <div class="row justify-content-md-center" style="margin-top: 150px">
        <div class="card shadow p-3 mb-5 bg-white rounded"  style="width: 30rem">
            <div class="card-header bg-transparent text-center">
              <b> LOGIN</b>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('qrreserva')}}" >
                        @csrf
                            <input type="hidden" name="posicao" value="{{$posicao ?? ''}}">
                            <input type="hidden" name="idempresa" value="{{$idempresa ?? ''}}">
                            <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" >
                            
                            </div>
                            <div class="form-group">
                            <label for="senha">Password</label>
                            <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                                    
                        
                            <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                  </form>
            </div>
            @isset($error)
               
                    <div class="alert alert-danger" role="alert">
                        {{$error}}
                      </div>
              
            @endisset
            
    
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>