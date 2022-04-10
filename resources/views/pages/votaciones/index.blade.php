@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Consulta votaciones</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped w-100">
                <thead>
                    <tr class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">Sesión</th>
                        <th scope="col">Votación</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Aprobado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votaciones as $votacion)
                        <tr>
                            <th scope="row">{{ $votacion->id }}</th>
                            <td>{{ $votacion->sesion }}</td>
                            <td>{{ $votacion->numeroVotacion }}</td>
                            <td>{{ $votacion->fecha }}</td>
                            <td>{{ $votacion->titulo }}</td>
                            @if ($votacion->asentimiento == 'Sí')
                                <td>-</td>
                            @elseif ($votacion->aprobada())
                                <td>Sí</td>
                            @else
                                <td>No</td>
                            @endif
                            <td class="col-2">
                                <a href="{{ route('votaciones.show', $votacion) }}" type="button"
                                    class="btn btn-primary">Ver detalle</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                {!! $votaciones->links() !!}
            </div>
        </div>
    </div>
@endsection
