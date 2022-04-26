@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Editar grupo {{ $grupo->id }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('grupos.update', $grupo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="id">Id</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="id" name="id" aria-describedby="idHelp"
                            placeholder="Introduzca id" value="{{ $grupo->id }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="nombre">Nombre</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="nombre" name="nombre" aria-describedby="nombreHelp"
                            placeholder="Introduzca nombre" value="{{ $grupo->nombre }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="diputados">Diputados</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="diputados" name="diputados"
                            aria-describedby="diputadosHelp" placeholder="Introduzca diputados"
                            value="{{ $grupo->diputados() }}" readonly>
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
