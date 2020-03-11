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

    <!--Estilo del carousel -->
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;            
        }
    </style>
</head>
<body>
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
                            <a class="nav-link" href="#">Proveedores</a>
                        </li>
                        <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Administración <span class="caret"></span>
                                </a>                                
                                @if (Route::has('register'))
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                             
                                       <a class="dropdown-item" href="{{ route('usuarios') }}">{{ __('Usuarios') }}</a>                       
                                </div> 
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                             
                                       <a class="dropdown-item" href="{{ route('categorias.index') }}">{{ __('Categorias') }}</a>                       
                                </div> 

                                @endif   
                                                
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                              Dropdown link
                            </a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">Link 1</a>
                              <a class="dropdown-item" href="#">Link 2</a>
                              <a class="dropdown-item" href="#">Link 3</a>
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
             @yield('content')
        </div>
          
        <!--Pie de pagina  -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-bottom">
           
            <a class="navbar-brand" href="#"><small><em>2020,Todos los derechos reservados</em></small></a>    
            <a class="navbar-brand ml-auto" href="#"><small><em>by Oscar Delgado Camacho</em></small></a>      
        </nav>

    </div>
</body>
</html>
