<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/icone/css/font-awesome.min.css")}}">
    <script src="{{asset('js/jquery.js')}}"></script>



  <title>Posição Ocupada por : {{$ocupante ?? ''}}</title>
  </head>
  <body>
    <div class="container" style="margin-top: 100px">
       
                      
                <div class="alert alert-info shadow p-3 mb-5 bg-white rounded" role="alert" id="aviso">
                   
                    @unless ($error ?? '')
                        <h5 class="alert-heading text-center">Posição Ocupada por : <br>{{$ocupante ?? ''}}</h5><br>
                    @endunless
                                        
                   

                    @isset($error)
                         <div class="alert alert-warning text-center" role="alert">
                                Ops!, Algo errado com as informações.
                            </div>
                    @endisset
                           
                    
                     <br>
                   
                     <div class="text-center"><button class="btn btn-info " id="soueu"><i class="fa fa-hand-peace-o " aria-hidden="true"></i> Sou eu </button></div>
                            
                </div>
                     


        
       
    </div>
    <div class="container" id="formID">
        <div class="card ">
            <div class="card-header">
              Check-in para posição : {{$posicao ?? ''}}
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('checado')}}" >
                    @csrf
                        <input type="hidden" name="posicao" value="{{$posicao ?? ''}}">
                        <input type="hidden" name="idempresa" value="{{$idempresa ?? ''}}">
                      <div class="form-group">
                        <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                      
                      </div>
                      <div class="form-group">
                        <label for="senha">Password</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                      </div>
                                 
                    
                      <div class="text-center"><button type="submit" class="btn btn-primary">Submit</button></div>
                    </form>
            </div>
            <div class="card-footer text-muted">
              
            </div>
          </div>
        
    </div>
   

  
    <script>
        $(function(){
            $("#formID").hide();
            $("#soueu").click(function(){
                $("#aviso").hide();
                $("#formID").fadeIn("slow");
                
            });

        })
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>