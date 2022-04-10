@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Consulta votos - Votación {{ $votacion }}</h1>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-left pb-2">
                <a href="{{ route('votaciones.show', $votacion) }}" type="button" class="col-2 btn btn-info">Volver</a>
            </div>
            <table class="table table-striped w-100">
                <thead>
                    <tr class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">Diputado</th>
                        <th scope="col">Partido</th>
                        <th scope="col">Voto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votos as $voto)
                        <tr>
                            <td scope="row">{{ $voto->id }}</td>
                            <td>{{ $voto->diputado()->nombrecompleto }}</td>
                            <td>{{ $voto->diputado()->partido() }}</td>
                            <td>{{ $voto->voto }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex">
                {!! $votos->links() !!}
            </div>
        </div>
    </div>
@endsection
