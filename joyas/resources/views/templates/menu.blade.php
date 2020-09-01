<!--Menu del sistema  -->
<div id="app" class="container-fluid">
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
                        <a class="nav-link" href="{{route('ventas.index')}}">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('proveedores.index')}}">Proveedores</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          Operaciones
                        </a>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{route('estado_cuenta.index') }}">Inversiones</a> 
                          <a class="dropdown-item" href="#">Retiros </a>
                          <a class="dropdown-item" href="{{route('ventas.index')}}">Ventas</a>
                        </div>
                    </li>
                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                          Administración
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('usuarios') }}">{{ __('Usuarios') }}</a>
                            <a class="dropdown-item" href="{{ route('categorias.index') }}">{{ __('Categorias') }}</a>
                            <a class="dropdown-item" href="{{ route('inversionistas.index') }}">Inversionistas</a>
                            <a class="dropdown-item" href="{{ route('reglas.index') }}">Reglas de negocio</a>
                             <a class="dropdown-item" href="{{ route('corte.index') }}">Corte</a>
                        </div>
                    </li>
                </ul>
</div>