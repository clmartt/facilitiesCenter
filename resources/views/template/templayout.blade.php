<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Power Service</title>



    <link href="{{asset('tempLayout/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="{{asset("css/icone/css/font-awesome.min.css")}}">
        
    <link rel="stylesheet" href="{{asset("css/cssdivs.css")}}">
    <!-- Custom styles for this template-->
    <link href="{{asset('tempLayout/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.js')}}"></script>

    @extends('js.validador')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <div class="sidebar-brand-text mx-2">Power Service</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <div id="clienteDash">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div id="clienteGestaoPosicoes">
                        <div class="sidebar-heading">
                            Gestão de Posições
                        </div>

                        <!-- Nav Item - Pages Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{route('posicoes')}}" >
                                <i class="fas fa-fw fa-cog"></i>
                                <span>Home</span>
                            </a>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                                aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <span>Consulta</span>
                            </a>
                            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    
                                    <a class="collapse-item" href="{{route('reservas')}}">Minhas Reservas</a>
                                    <a class="collapse-item" href="{{route('bloqueadas')}}">Posições Bloqueadas</a>
                                    <a class="collapse-item" href="{{route('colaborador')}}">Colaboradores</a>
                                
                                    
                                    
                                </div>   
                                
                            </div>
                            
                        </li>
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGrupo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Grupos</span>
                        </a>
                        <div id="collapseGrupo" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                
                                <a class="collapse-item" href="{{route('formGrupo')}}">Novo Grupo</a>
                                <a class="collapse-item" href="{{route('listaGrupos')}}">Visualizar Grupos</a>
                               
                            
                                
                                
                            </div>   
                            
                        </div>
                            
                        </li>

                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecc"
                                aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                                <span>Centro de Custo</span>
                            </a>
                            <div id="collapsecc" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    
                                    <a class="collapse-item" href="{{route('formNovoCentroCusto')}}">Novo Centro de Custo</a>
                                    <a class="collapse-item" href="{{route('listaCentroCusto')}}">Listar Centro de Custo</a>
                                   
                                
                                    
                                    
                                </div>   
                                
                            </div>
                            
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                                aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span>Usuários</span>
                            </a>
                            <div id="collapseUser" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    
                                    <a class="collapse-item" href="{{route('novoUsuario')}}">Novo Usuário</a>
                                    <a class="collapse-item" href="{{route('listaUsuario')}}">Visualizar Usuários</a>
                                   
                                
                                    
                                    
                                </div>   
                                
                            </div>
                            
                        </li>

            </div>

            <!-- Divider ------------------------------------------------------------------------------>
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div id="clienteGestaoEstacionamento">
                        <div class="sidebar-heading">
                            Gestão Estacionamento
                        </div>

                            <!-- Nav Item - Pages Collapse Menu -->
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="{{route('garagem')}}" >
                                    <i class="fas fa-fw fa-cog"></i>
                                    <span>Home</span>
                                </a>
                                
                            </li>

                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGaragem"
                                    aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Consulta</span>
                                </a>
                                <div id="collapseGaragem" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">

                                        <a class="collapse-item" href="{{route('reservavaga')}}">Reservar Vaga</a>
                                        <a class="collapse-item" href="{{route('minhasreservas')}}">Minhas Reservas</a>
                                        <a class="collapse-item" href="{{route('colabgaragem')}}">Colaboradores</a>
                                        <h6 class="collapse-header">Alterar:</h6>
                                        <a class="collapse-item" href="{{route('qtdvaga')}}">Nº Vaga</a>

                                                            
                                    
                                        
                                        
                                    </div>   
                                    
                                </div>
                                
                            </li>
            </div>

                <!-- Nav Item - Pages Collapse Menu -->
               

                <!-- Nav Item - Utilities Collapse Menu -->
             
                <!-- Nav Item - Utilities Collapse Menu -->
               
                <!-- Nav Item - Utilities Collapse Menu -->
              

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div id="clienteGestaoSala">
                        <div class="sidebar-heading">
                            Gestão Salas de Reunião
                        </div>
                        <!-- Nav Item - Utilities Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{route('kvmp01')}}">
                                <i class="fas fa-fw fa-wrench"></i>
                                <span>01 Andar</span>
                            </a>
                            
                        </li>

            </div>
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
                <div id="clienteGestaoVisitante">
                        <div class="sidebar-heading">
                            Gestão Visitantes
                        </div>
                        <!-- Nav Item - Utilities Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{route('visitante')}}">
                                <i class="fas fa-fw fa-wrench"></i>
                                <span>Home</span>
                            </a>
                            
                        </li>
                        <!-- Nav Item - Utilities Collapse Menu -->
                        <li class="nav-item">
                            <a class="nav-link collapsed" href="{{route('convite')}}">
                                <i class="fas fa-fw fa-wrench"></i>
                                <span>Convite</span>
                            </a>
                            
                        </li>

                </div>
        


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card">
             
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{"/".$route = Route::current()->getName()}}">
                        <div class="input-group">
                            
                                @csrf
                                  <input type="hidden" value="{{$sala ?? ''}}" name="sala"> 
                                  <input class="form-control mr-sm-2 border border-primary" type="date" name="dia">
                                  <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                              
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="{{asset('tempLayout/img/undraw_profile_1.svg')}}"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                   
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <img class="img-profile " src="{{asset('img/logobv.png')}}"> - {{session()->get('nome')}}
                                   @if (session()->get('perfil') == 'adm')
                                     <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                   @endif</span>
                                <img class="img-profile rounded-circle" src="{{asset('tempLayout/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" >
                                    <i class="fas fa fa-users fa-sm fa-fw mr-2 " style="color: {{session()->get('corGrupo')}}"></i>
                                    {{session()->get('nomeGrupo')}}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{route('sair')}}" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container-fluid">
                    @yield('layout')


                </div>
                <!-- /.container-fluid -->
                @extends('js.script')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Developed by KVMT</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Realizar Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Ao clicar em sair suas atividades serão encerradas!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{route('sair')}}">Sair</a>
                </div>
            </div>
        </div>
    </div>

    


             





  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   
</body>

</html>