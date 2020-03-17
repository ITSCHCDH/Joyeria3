<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{'JoyasFREDKIOS'}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Iconos google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!-- Iconos awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Estilo del carousel -->
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;            
        }
    </style>
</head>
<body>
    <!--Incluir jQuery  -->
    <script src="{{asset('jQuery/jquery-3.4.1.js')}}"></script>

    <!--Menu del sistema  -->
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">            
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('imagenes/Logo.png') }}" alt="logo" style="width:40px;">
                </a>
                <a class="navbar-brand" href="#">
                    {{ 'JoyasFREDKIOS' }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                        @if (Auth::check())
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('articulos.index')}}">Articulos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('proveedores.index')}}">Proveedores</a>
                        </li>
                       
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                              Administración
                            </a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('usuarios') }}">{{ __('Usuarios') }}</a>
                              <a class="dropdown-item" href="{{ route('categorias.index') }}">{{ __('Categorias') }}</a>
                              <a class="dropdown-item" href="{{ route('inversionistas.index') }}">Inversionistas</a>
                            </div>
                        </li>
                    </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logeo') }}">{{ __('Inicio') }}</a>
                            </li>
                            <!-- Codigo necesario para el registro del primer usuario del sistema -->
                            <!--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif-->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('logout') }}"

                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons" style="font-size:15px">exit_to_app</i>
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div>
            <br><br><br>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    @include('templates.flash-message')
                    @yield('content')
                </div>
                <div class="col-sm-2"></div>
            </div>
             
        </div>
          
        <!--Pie de pagina  -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom">
           
            <a class="navbar-brand" href="#"><small><em>2020,Todos los derechos reservados</em></small></a>    
            <a class="navbar-brand ml-auto" href="#"><small><em>by Oscar Delgado Camacho</em></small></a>      
        </nav>

    </div>
    
    
    <script>
        //Script qwue cierra los mensajes flash de forma automatica
        $(document).ready(function(event)
        {
            $('.mdshide').delay(2000).fadeOut(300);
        });  
    </script>
</body>
</html>
