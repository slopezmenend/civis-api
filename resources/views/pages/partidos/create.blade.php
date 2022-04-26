@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Crear partido</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('partidos.store') }}" method="POST">
                @csrf

                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="nombre">Nombre</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp"
                            placeholder="Introduzca nombre">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="urllogo">URL Logo</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="urllogo" name="urllogo" aria-describedby="urllogoHelp"
                            placeholder="Introduzca urllogo">
                    </div>
                </div>

                <div class="row justify-content-md-center pb-2">
                    <button type="submit" class="col-6 btn btn-info">Guardar</button>
                </div>

                <div class="row justify-content-md-center pb-2">
                    <a href="{{ url()->previous() }}" type="button" class="col-6 btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
