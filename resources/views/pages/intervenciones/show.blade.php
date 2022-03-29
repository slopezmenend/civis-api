@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Detalle intervencion {{ $intervencion->id }}</h1>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="id">Id</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="id" aria-describedby="idHelp"
                            placeholder="Introduzca id" value="{{ $intervencion->id }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="legislatura">Legislatura</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="legislatura" aria-describedby="legislaturaHelp"
                            placeholder="Introduzca legislatura" value="{{ $intervencion->legislatura }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="objeto">Objeto</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="objeto" aria-describedby="objetoHelp"
                            placeholder="Introduzca objeto" value="{{ $intervencion->objeto }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="sesion">Sesión</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" id="sesion" aria-describedby="sesionHelp"
                            placeholder="Introduzca sesion" value="{{ $intervencion->sesion }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="organo">Órgano</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="organo" aria-describedby="organoHelp"
                            placeholder="Introduzca organo" value="{{ $intervencion->organo }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="fase">Fase</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="fase" aria-describedby="faseHelp"
                            placeholder="Introduzca fase" value="{{ $intervencion->fase }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="tipoIntervencion">Tipo</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="tipoIntervencion"
                            aria-describedby="tipoIntervencionHelp" placeholder="Introduzca tipoIntervencion"
                            value="{{ $intervencion->tipoIntervencion }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="diputado">Diputado</label>
                    </div>
                    @if (isset($intervencion->diputado()->nombrecompleto))
                        <div class="col">
                            <input type="text" class="form-control" id="diputado" aria-describedby="diputadoHelp"
                                placeholder="Introduzca diputado" value="{{ $intervencion->diputado()->nombrecompleto }}"
                                readonly>
                        </div>
                    @else
                        <div class="col">
                            <input type="text" class="form-control" id="diputado" aria-describedby="diputadoHelp"
                                placeholder="Introduzca diputado" value="" readonly>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="cargo">Cargo</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="cargo" aria-describedby="cargoHelp"
                            placeholder="Introduzca cargo" value="{{ $intervencion->cargo }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="inicio">Inicio</label>
                    </div>
                    <div class="col">
                        <input type="time" class="form-control" id="inicio" aria-describedby="inicioHelp"
                            placeholder="Introduzca inicio" value="{{ $intervencion->inicio }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="fin">Fin</label>
                    </div>
                    <div class="col">
                        <input type="time" class="form-control" id="fin" aria-describedby="finHelp"
                            placeholder="Introduzca fin" value="{{ $intervencion->fin }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceDiferido">Diferido</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceDiferido" aria-describedby="enlaceDiferidoHelp"
                            placeholder="Introduzca enlaceDiferido" value="{{ $intervencion->enlaceDiferido }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceDescargaDirecta">Descarga Directa</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceDescargaDirecta"
                            aria-describedby="enlaceDescargaDirectaHelp" placeholder="Introduzca enlaceDescargaDirecta"
                            value="{{ $intervencion->enlaceDescargaDirecta }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceTextoIntegro">TextoIntegro</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceTextoIntegro"
                            aria-describedby="enlaceTextoIntegroHelp" placeholder="Introduzca enlaceTextoIntegro"
                            value="{{ $intervencion->enlaceTextoIntegro }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="EnlacePDF">PDF</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="EnlacePDF" aria-describedby="EnlacePDFHelp"
                            placeholder="Introduzca EnlacePDF" value="{{ $intervencion->EnlacePDF }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="enlaceSubtitles">Subtitulos</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="enlaceSubtitles"
                            aria-describedby="enlaceSubtitlesHelp" placeholder="Introduzca enlaceSubtitles"
                            value="{{ $intervencion->enlaceSubtitles }}" readonly>
                    </div>
                </div>
        </div>

        <div class="row justify-content-md-center pb-2">
            <a href="{{ url()->previous() }}" type="button" class="col-6 btn btn-info">Volver</a>
        </div>
        </form>
    </div>
    </div>
@endsection
