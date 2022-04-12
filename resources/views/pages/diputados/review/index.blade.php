@extends ('layouts.frontend')

@section('content')
    <div class="card m-4">
        <div class="card-header">
            <h4>Listado Diputados a revisar</h4>
            <!--<form action="search" method="GET">
                                                                                            <input type="text" name="search" required />
                                                                                            <button type="submit">Buscar</button>
                                                                                        </form>-->
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Circunscripción</th>
                            <th scope="col">Partido</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diputados as $diputado)
                            <tr>
                                <th scope="row">{{ $diputado->id }}</th>
                                <td>{{ $diputado->nombre }}</td>
                                <td>{{ $diputado->circunscripcion }}</td>
                                <td>{{ $diputado->partido }}</td>
                                <td>
                                    <a href="{{ route('diputados.review.show', $diputado) }}" type="button"
                                        class="btn btn-primary">Ver
                                        datos importados</a>
                                    <a href="{{ route('diputados.review.edit', $diputado) }}" type="button"
                                        class="btn btn-primary">Revisar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex">
                {!! $diputados->links() !!}
            </div>
        </div>
    </div>
@endsection
