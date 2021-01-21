<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
  
    <div class="row justify-content-md-center" style="margin-top: 150px">
    <div class="card shadow p-3 mb-5 bg-white rounded"  style="width: 30rem">
      <div class="card-header bg-transparent text-center">
        <b> LOGIN</b>
      </div>
      <div class="card-body">
          <form method="POST" action="{{route('modulos')}}">
            @csrf
              <div class="form-group">
                <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{$user ?? ''}}">
              
              </div>
              <div class="form-group">
                <label for="senha">Password</label>
                <input type="password" class="form-control" id="senha" name="senha">
              </div>
                         
            
              <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
            </form>
      </div>
      @isset($erro)
      <div class="card-footer text-center">
                 <div class="alert alert-danger" role="alert">
                  {{$erro}}
                </div>
      </div>
          
      @endisset
    </div>
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>