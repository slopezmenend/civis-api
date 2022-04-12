@extends ('layouts.frontend')

@section('content')
    <h1>Civis API Dashboard</h1>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Diputados</h4>

        <div class="card-group text-primary">
            <div class="card">
                <a href="{{ route('diputados.index') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-briefcase-fill primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['diputados']['creados'] }}</h3>
                                <span>Creados</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @if (!$summary['diputados']['status'])
                <div class="card">
                    <a href="{{ route('diputados.importar') }}" class="text-decoration-none" aria-disabled="true">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-calendar-date primary h1 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{ $summary['diputados']['fechaimp'] }}</h3>
                                    <span>Última ejecución importado</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card">
                    <a href="{{ route('importar-diputados.index') }}" class="text-decoration-none">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-pencil primary h1 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{ $summary['diputados']['pendientes'] }}</h3>
                                    <span>Pendientes de revisión</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-calendar-date primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <div class="progress ml-4">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        aria-valuenow="{{ $summary['diputados']['porcentaje'] }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $summary['diputados']['porcentaje'] }}%">
                                    </div>
                                </div>
                                <span>Importado en progreso ({{ $summary['diputados']['porcentaje'] }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-pencil primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['diputados']['pendientes'] }}</h3>
                                <span>Pendientes de revisión</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Votaciones</h4>

        <div class="card-group text-primary">
            <div class="card">
                <a href="{{ route('votaciones.index') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-briefcase-fill primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['votaciones']['votaciones'] }}</h3>
                                <span>Votaciones</span>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['votaciones']['votos'] }}</h3>
                                <span>Votos</span>
                            </div>

                        </div>
                    </div>
                </a>
            </div>

            @if ($summary['votaciones']['status'])
                <div class="card">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-calendar-date primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <div class="progress ml-4">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        aria-valuenow="{{ $summary['votaciones']['porcentaje'] }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $summary['votaciones']['porcentaje'] }}%">
                                    </div>
                                </div>
                                <span>Importado en progreso ({{ $summary['votaciones']['porcentaje'] }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <a href="{{ route('votaciones.importar') }}" class="text-decoration-none" aria-disabled="true">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-calendar-date primary h1 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{ $summary['votaciones']['fechaimp'] }}</h3>
                                    <span>Última ejecución importado</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

        </div>
    </div>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Intervenciones</h4>

        <div class="card-group text-primary">
            <div class="card">
                <a href="{{ route('intervenciones.index') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-briefcase-fill primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['intervenciones']['creados'] }}</h3>
                                <span>Creadas</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @if (!$summary['intervenciones']['status'])
                <div class="card">
                    <a href="{{ route('intervenciones.importar') }}" class="text-decoration-none" aria-disabled="true">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-calendar-date primary h1 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{ $summary['intervenciones']['fechaimp'] }}</h3>
                                    <span>Última ejecución importado</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="card">
                    <a href="{{ route('intervenciones.revisar') }}" class="text-decoration-none">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="bi bi-pencil primary h1 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{ $summary['intervenciones']['pendientes'] }}</h3>
                                    <span>Pendientes de revisión</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-calendar-date primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <div class="progress ml-4">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        aria-valuenow="{{ $summary['intervenciones']['porcentaje'] }}" aria-valuemin="0"
                                        aria-valuemax="100"
                                        style="width: {{ $summary['intervenciones']['porcentaje'] }}%">
                                    </div>
                                </div>
                                <span>Importado en progreso ({{ $summary['intervenciones']['porcentaje'] }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-pencil primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['intervenciones']['pendientes'] }}</h3>
                                <span>Pendientes de revisión</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Auxiliares</h4>

        <div class="card-group text-primary">

            <div class="card">
                <a href="{{ route('partidos.index') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-briefcase-fill primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['partidos'] }}</h3>
                                <span>Partidos</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="{{ route('grupos.index') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-briefcase-fill primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['grupos'] }}</h3>
                                <span>Grupos</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="{{ route('circunscripciones.index') }}" class="text-decoration-none">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-center">
                                <i class="bi bi-briefcase-fill primary h1 float-left"></i>
                            </div>
                            <div class="media-body text-right">
                                <h3>{{ $summary['circunscripciones'] }}</h3>
                                <span>Circunscripciones</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
