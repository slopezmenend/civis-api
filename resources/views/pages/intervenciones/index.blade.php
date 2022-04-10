@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h4>Listado Intervenciones</h4>
            <!--<form action="search" method="GET">
                                                                                        <input type="text" name="search" required />
                                                                                        <button type="submit">Buscar</button>
                                                                                    </form>-->
        </div>
        <div class="card-body">
            <table class="table table-striped w-100">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Diputado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora Inicio</th>
                        <th scope="col">Hora Fin</th>
                        <th scope="col">Objeto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($intervenciones as $intervencion)
                        <tr>
                            <th scope="row">{{ $intervencion->id }}</th>
                            <td>{{ $intervencion->diputado()->nombrecompleto }}</td>
                            <td>{{ $intervencion->sesion }}</td>
                            <td>{{ $intervencion->inicio }}</td>
                            <td>{{ $intervencion->fin }}</td>
                            <td>{{ $intervencion->objeto }}</td>
                            <td>
                                <a href="{{ route('intervenciones.show', $intervencion) }}" type="button"
                                    class="btn btn-primary">Ver
                                    detalle</a>
                                <a href="{{ route('intervenciones.edit', $intervencion) }}" type="button"
                                    class="btn btn-primary">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                {!! $intervenciones->links() !!}
            </div>
        </div>
    </div>
@endsection
