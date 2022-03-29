@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Detalle diputado {{ $diputado->id }}</h1>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="nombrec">Nombre completo</label>
                    <input type="text" class="form-control" id="nombrec" aria-describedby="nombrecHelp"
                        placeholder="Introduzca nombre completo" value='{{ $diputado->nombrecompleto }}' readonly>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp"
                        placeholder="Introduzca nombre" value='{{ $diputado->nombre }}' readonly>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" aria-describedby="apellidosHelp"
                        placeholder="Introduzca apellidos" value='{{ $diputado->apellidos }}' readonly>
                </div>
                <div class="form-group">
                    <label for="circunscripcion">Circunscripción</label>
                    <input type="text" class="form-control" id="circunscripcion" aria-describedby="cirHelp"
                        placeholder="Introduzca circunscripción" value='{{ $diputado->circunscripcion() }}' readonly>
                </div>
                <div class="form-group">
                    <label for="partido">Partido</label>
                    <input type="text" class="form-control" id="partido" aria-describedby="partidoHelp"
                        placeholder="Introduzca partido" value='{{ $diputado->partido() }}' readonly>

                </div>
                <div class="form-group">
                    <label for="fechacondicion">Fecha condicion plena</label>
                    <input type="date" class="form-control" id="fechacondicion" aria-describedby="fechacondicionHelp"
                        placeholder="Introduzca fecha condicion plena" value={{ $diputado->fechacondicionplena }}
                        readonly>
                </div>
                <div class="form-group">
                    <label for="fechaalta">Fecha alta</label>
                    <input type="date" class="form-control" id="fechaalta" aria-describedby="fechaaltaHelp"
                        placeholder="Introduzca fecha alta" value={{ $diputado->fechaalta }} readonly>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control" id="grupo" aria-describedby="grupoHelp"
                        placeholder="Introduzca grupo" value='{{ $diputado->grupo() }}' readonly>
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea class="form-control" id="biografia" rows="5"
                        readonly>{{ $diputado->biografia }}</textarea>
                </div>
        </div>

        <a href="{{ url()->previous() }}" type="button" class="btn btn-info">Volver</a>
        </form>
    </div>
    </div>
@endsection
