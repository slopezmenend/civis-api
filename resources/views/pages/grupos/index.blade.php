@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header d-flex justify-content-between">
            <h4>Listado grupos</h4>
            <!--<form action="search" method="GET">
                                                                                                    <input type="text" name="search" required />
                                                                                                    <button type="submit">Buscar</button>
                                                                                                </form>-->
            <a href="{{ route('grupos.create') }}" type="button" class="btn btn-primary">Crear</a>
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
                        @foreach ($grupos as $grupo)
                            <tr>
                                <th scope="row">{{ $grupo->id }}</th>
                                <td>{{ $grupo->nombre }}</td>
                                <td>{{ $grupo->diputados() }}</td>
                                <td>
                                    <a href="{{ route('grupos.show', $grupo) }}" type="button" class="btn btn-primary">Ver
                                        detalle</a>
                                    <a href="{{ route('grupos.edit', $grupo) }}" type="button"
                                        class="btn btn-primary">Editar</a>
                                    <a href="{{ route('grupos.destroy', $grupo) }}" method="DELETE" type="button"
                                        class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                {!! $grupos->links() !!}
            </div>
        </div>
    </div>
@endsection
