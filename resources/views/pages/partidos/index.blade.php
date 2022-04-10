@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header d-flex justify-content-between">
            <h4>Listado Partidos</h4>
            <!--<form action="search" method="GET">
                                                                                            <input type="text" name="search" required />
                                                                                            <button type="submit">Buscar</button>
                                                                                        </form>-->
            <a href="{{ route('partidos.create') }}" type="button" class="btn btn-primary">Crear</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partidos as $partido)
                            <tr>
                                <th scope="row">{{ $partido->id }}</th>
                                <td>{{ $partido->nombre }}</td>
                                <td>
                                    @if ($partido->urllogo == '')
                                        -
                                    @else
                                        <img src="{{ $partido->urllogo }}" alt="Logo oficial del {{ $partido->nombre }}"
                                            width="50" height="60">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('partidos.show', $partido) }}" type="button"
                                        class="btn btn-primary">Ver
                                        detalle</a>
                                    <a href="{{ route('partidos.edit', $partido) }}" type="button"
                                        class="btn btn-primary">Editar</a>
                                    <a href="{{ route('partidos.destroy', $partido) }}" method="DELETE" type="button"
                                        class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                {!! $partidos->links() !!}
            </div>
        </div>
    </div>
@endsection
