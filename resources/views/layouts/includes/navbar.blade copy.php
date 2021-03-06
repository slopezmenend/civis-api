<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">
        <img src="/storage/app/icon.png" width="40" height="40" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
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
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Votaciones
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('votaciones.index') }}">Creadas</a>
                    <a class="dropdown-item" href="{{ route('votaciones.importar') }}">Importar</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Intervenciones
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('intervenciones.index') }}">Creados</a>
                    <a class="dropdown-item" href="{{ route('intervenciones.importar') }}">Importar</a>
                    <a class="dropdown-item" href="{{ route('intervenciones.revisar') }}">Revisar</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Auxiliares
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('partidos.index') }}">Partidos</a>
                    <a class="dropdown-item" href="{{ route('grupos.index') }}">Grupos</a>
                    <a class="dropdown-item" href="{{ route('circunscripciones.index') }}">Circunscripciones</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="/login" class="btn btn-outline-info my-2 my-sm-0" type="submit">Login</a>
            <a href="/signup" class="btn btn-outline-info my-2 my-sm-0" type="submit">Signup</a>
        </form>
    </div>
</nav>
