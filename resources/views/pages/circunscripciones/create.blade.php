@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Crear circunscripción</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('circunscripciones.store') }}" method="POST">
                @csrf
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="nombre">Nombre</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp"
                            placeholder="Introduzca nombre">
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
