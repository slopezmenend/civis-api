@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Editar intervencion {{ $intervencion->id }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('intervenciones.update', $intervencion->id) }}" method="post">
                @csrf
                @method("put")

                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="id">Id</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="id" name="id" aria-describedby="idHelp"
                            placeholder="Introduzca id" value="{{ $intervencion->id }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="legislatura">Legislatura</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="legislatura" name="legislatura"
                            aria-describedby="legislaturaHelp" placeholder="Introduzca legislatura"
                            value="{{ $intervencion->legislatura }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="objeto">Objeto</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="objeto" name="objeto" aria-describedby="objetoHelp"
                            placeholder="Introduzca objeto" value="{{ $intervencion->objeto }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="sesion">Sesión</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" id="sesion" name="sesion" aria-describedby="sesionHelp"
                            placeholder="Introduzca sesion" value="{{ $intervencion->sesion }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="organo">Órgano</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="organo" name="organo" aria-describedby="organoHelp"
                            placeholder="Introduzca organo" value="{{ $intervencion->organo }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="fase">Fase</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="fase" name="fase" aria-describedby="faseHelp"
                            placeholder="Introduzca fase" value="{{ $intervencion->fase }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="tipoIntervencion">Tipo</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="tipoIntervencion" name="tipoIntervencion"
                            aria-describedby="tipoIntervencionHelp" placeholder="Introduzca tipoIntervencion"
                            value="{{ $intervencion->tipoIntervencion }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="diputado">Diputado</label>
                    </div>
                    @if (isset($intervencion->diputado()->nombrecompleto))
                        <div class="col">
                            <select id="diputado" name="diputado" class="form-control">
                                @foreach ($diputados as $diputado)
                                    @if ($intervencion->diputado_id == $diputado->id)
                                        <option value='{{ $diputado->nombrecompleto }}' selected>
                                            {{ $diputado->nombrecompleto }}
                                        </option>
                                    @else
                                        <option value='{{ $diputado->nombrecompleto }}'>
                                            {{ $diputado->nombrecompleto }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="col">
                            <input type="text" class="form-control" id="diputado" name="diputado"
                                aria-describedby="diputadoHelp" placeholder="Introduzca diputado" value="">
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="cargo">Cargo</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="cargo" name="cargo" aria-describedby="cargoHelp"
                            placeholder="Introduzca cargo" value="{{ $intervencion->cargo }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="inicio">Inicio</label>
                    </div>
                    <div class="col">
                        <input type="time" class="form-control" id="inicio" name="inicio" aria-describedby="inicioHelp"
                            placeholder="Introduzca inicio" value="{{ $intervencion->inicio }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="fin">Fin</label>
                    </div>
                    <div class="col">
                        <input type="time" class="form-control" id="fin" name="fin" aria-describedby="finHelp"
                            placeholder="Introduzca fin" value="{{ $intervencion->fin }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceDiferido">Diferido</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceDiferido" name="enlaceDiferido"
                            aria-describedby="enlaceDiferidoHelp" placeholder="Introduzca enlaceDiferido"
                            value="{{ $intervencion->enlaceDiferido }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceDescargaDirecta">Descarga Directa</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceDescargaDirecta" name="enlaceDescargaDirecta"
                            aria-describedby="enlaceDescargaDirectaHelp" placeholder="Introduzca enlaceDescargaDirecta"
                            value="{{ $intervencion->enlaceDescargaDirecta }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceTextoIntegro">TextoIntegro</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceTextoIntegro" name="enlaceTextoIntegro"
                            aria-describedby="enlaceTextoIntegroHelp" placeholder="Introduzca enlaceTextoIntegro"
                            value="{{ $intervencion->enlaceTextoIntegro }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="EnlacePDF">PDF</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="EnlacePDF" name="EnlacePDF"
                            aria-describedby="EnlacePDFHelp" placeholder="Introduzca EnlacePDF"
                            value="{{ $intervencion->EnlacePDF }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceSubtitles">Subtitulos</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceSubtitles" name="enlaceSubtitles"
                            aria-describedby="enlaceSubtitlesHelp" placeholder="Introduzca enlaceSubtitles"
                            value="{{ $intervencion->enlaceSubtitles }}">
                    </div>
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
