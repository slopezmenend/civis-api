@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header d-flex justify-content-between">
            <h4>Listado circunscripciones</h4>
            <!--<form action="search" method="GET">
                                                                                                            <input type="text" name="search" required />
                                                                                                            <button type="submit">Buscar</button>
                                                                                                        </form>-->
            <a href="{{ route('circunscripciones.create') }}" type="button" class="btn btn-primary">Crear</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Diputados</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($circunscripciones as $circunscripcion)
                            <tr>
                                <th scope="row">{{ $circunscripcion->id }}</th>
                                <td>{{ $circunscripcion->nombre }}</td>
                                <td>{{ $circunscripcion->diputados() }}</td>
                                <td>
                                    <a href="{{ route('circunscripciones.show', $circunscripcion) }}" type="button"
                                        class="btn btn-primary">Ver
                                        detalle</a>
                                    <a href="{{ route('circunscripciones.edit', $circunscripcion) }}" type="button"
                                        class="btn btn-primary">Editar</a>
                                    <a href="{{ route('circunscripciones.destroy', $circunscripcion) }}" method="DELETE"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                {!! $circunscripciones->links() !!}
            </div>
        </div>
    </div>
@endsection
