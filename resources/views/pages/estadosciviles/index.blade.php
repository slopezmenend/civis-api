@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header d-flex justify-content-between">
            <h4>Listado estados civiles</h4>
            <!--<form action="search" method="GET">
                                                                                                                            <input type="text" name="search" required />
                                                                                                                            <button type="submit">Buscar</button>
                                                                                                                        </form>-->
            <a href="{{ route('estadosciviles.create') }}" type="button" class="btn btn-primary">Crear</a>
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
                        @foreach ($estadosciviles as $estadocivil)
                            <tr>
                                <th scope="row">{{ $estadocivil->id }}</th>
                                <td>{{ $estadocivil->nombre }}</td>
                                <td>{{ $estadocivil->diputados() }}</td>
                                <td>
                                    <a href="{{ route('estadosciviles.show', $estadocivil) }}" type="button"
                                        class="btn btn-primary">Ver
                                        detalle</a>
                                    <a href="{{ route('estadosciviles.edit', $estadocivil) }}" type="button"
                                        class="btn btn-primary">Editar</a>
                                    <a href="{{ route('estadosciviles.destroy', $estadocivil) }}" method="DELETE"
                                        type="button" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                {!! $estadosciviles->links() !!}
            </div>
        </div>
    </div>
@endsection
