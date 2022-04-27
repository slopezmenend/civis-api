@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header d-flex justify-content-between">
            <h4>Listado sexos</h4>
            <!--<form action="search" method="GET">
                                                                                                            <input type="text" name="search" required />
                                                                                                            <button type="submit">Buscar</button>
                                                                                                        </form>-->
            <a href="{{ route('sexos.create') }}" type="button" class="btn btn-primary">Crear</a>
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
                        @foreach ($sexos as $sexo)
                            <tr>
                                <th scope="row">{{ $sexo->id }}</th>
                                <td>{{ $sexo->nombre }}</td>
                                <td>{{ $sexo->diputados() }}</td>
                                <td>
                                    <a href="{{ route('sexos.show', $sexo) }}" type="button" class="btn btn-primary">Ver
                                        detalle</a>
                                    <a href="{{ route('sexos.edit', $sexo) }}" type="button"
                                        class="btn btn-primary">Editar</a>
                                    <a href="{{ route('sexos.destroy', $sexo) }}" method="DELETE" type="button"
                                        class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                {!! $sexos->links() !!}
            </div>
        </div>
    </div>
@endsection
