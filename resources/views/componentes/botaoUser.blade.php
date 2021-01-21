<div class="btn-group">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
     @if (session()->get('perfil')=='adm')
     <i class="fa fa-star" aria-hidden="true"></i> - 
     @endif  {{session()->get('nome')}}
             </button>
             <div class="dropdown-menu">
               @if (session()->get('perfil')=='adm')
               <a class="dropdown-item" href="{{route('newuser')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> Novo Usuário</a>
               
               @endif
               <a class="dropdown-item" href="/signout"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a>
                 
             
             </div>
</div> 