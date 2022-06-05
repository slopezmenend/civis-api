<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        <img src="{{ asset('images/CIVIS-API.jpg') }}" width="40" height="40" alt="">
        <!--<img src="https://ibb.co/c8vSJXX" width="40" height="40" alt="">-->
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if (Route::has('login'))
            <ul class="navbar-nav mr-auto">
                @auth

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Diputados
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('diputados.index') }}">Creados</a>
                            <a class="dropdown-item" href="{{ route('diputados.importar') }}">Importar</a>
                            <a class="dropdown-item" href="{{ route('importar-diputados.index') }}">Revisar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Votaciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('votaciones.index') }}">Creadas</a>
                            <a class="dropdown-item" href="{{ route('votaciones.importar') }}">Importar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Intervenciones
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('intervenciones.index') }}">Creados</a>
                            <a class="dropdown-item" href="{{ route('intervenciones.importar') }}">Importar</a>
                            <a class="dropdown-item" href="{{ route('intervenciones.revisar') }}">Revisar</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Auxiliares
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('partidos.index') }}">Partidos</a>
                            <a class="dropdown-item" href="{{ route('grupos.index') }}">Grupos</a>
                            <a class="dropdown-item" href="{{ route('circunscripciones.index') }}">Circunscripciones</a>
                            <a class="dropdown-item" href="{{ route('estadosciviles.index') }}">Estados Civiles</a>
                            <a class="dropdown-item" href="{{ route('sexos.index') }}">Sexos</a>
                        </div>
                    </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="/eps">Listado EPs</a></a>
                </li>
            </ul>
        @endif

        <div class="form-inline my-2 my-lg-0">

            @if (Route::has('login'))
                @auth
                    <div class="mr-1 text-white">Hola "{{ Auth::user()->name }}"!!</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault();
                                                                                                                this.closest('form').submit();"
                            class="mr-1 ml-1 btn btn-outline-info my-2 my-sm-0">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-info my-2 my-sm-0">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline-info my-2 my-sm-0">Registrar</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>
