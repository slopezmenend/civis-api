@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Consulta votaciones</h1>
        </div>
        <div class="card-body p-5">
            <form>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label for="sesion" class="font-weight-bold">Sesion</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="sesion" aria-describedby="sesionHelp"
                            placeholder="Introduzca sesion" value="{{ $votacion->sesion }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="votacion">Votación</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="votacion" aria-describedby="votacionHelp"
                            placeholder="Introduzca votacion" value="{{ $votacion->numeroVotacion }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="fecha">Fecha</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" id="fecha" aria-describedby="fechaHelp"
                            placeholder="Introduzca fecha" value="{{ $votacion->fecha }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="titulo">Título</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="titulo" aria-describedby="tituloHelp"
                            placeholder="Introduzca titulo" value="{{ $votacion->titulo }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="textoExpediente">Texto Expediente</label>
                    </div>
                    <div class="col">
                        <textarea class="form-control" id="textoExpediente" rows="5"
                            readonly>{{ $votacion->textoExpediente }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="presentes">Presentes</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="presentes" aria-describedby="presentesHelp"
                            placeholder="Introduzca presentes" value="{{ $votacion->presentes }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="afavor">A favor</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="afavor" aria-describedby="afavorHelp"
                            placeholder="Introduzca afavor" value="{{ $votacion->afavor }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="encontra">En contra</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="encontra" aria-describedby="encontraHelp"
                            placeholder="Introduzca encontra" value="{{ $votacion->enContra }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="abstenciones">Abstenciones</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="abstenciones" aria-describedby="abstencionesHelp"
                            placeholder="Introduzca abstenciones" value="{{ $votacion->abstenciones }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="novotan">No votan</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="novotan" aria-describedby="novotanHelp"
                            placeholder="Introduzca novotan" value="{{ $votacion->noVotan }}" readonly>
                    </div>
                </div>
                @if ($votacion->presentes > 0)
                    <div class="row justify-content-md-center pb-2">
                        <a href="{{ route('votos.index', $votacion->id) }}" type="button" class="col-6 btn btn-info">Ver
                            Detalle</a>
                    </div>
                @endif
                <div class="row justify-content-md-center pb-2">
                    <a href="{{ route('votaciones.index') }}" type="button" class="col-6 btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
@endsection
