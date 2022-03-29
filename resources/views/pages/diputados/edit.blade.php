@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Editar diputado {{ $diputado->id }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('diputados.update', $diputado) }}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <label for="nombrecompleto">Nombre completo</label>
                    <input type="text" class="form-control" name="nombrecompleto" id="nombrecompleto"
                        aria-describedby="nombrecHelp" placeholder="Introduzca nombre completo"
                        value='{{ $diputado->nombrecompleto }}'>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="nombreHelp"
                        placeholder="Introduzca nombre" value='{{ $diputado->nombre }}'>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos"
                        aria-describedby="apellidosHelp" placeholder="Introduzca apellidos"
                        value='{{ $diputado->apellidos }}'>
                </div>
                <div class="form-group">
                    <label for="circunscripcion">Circunscripción</label>
                    <select name="circunscripcion" id="circunscripcion" class="form-control">
                        @foreach ($circunscripciones as $circunscripcion)
                            @if ($circunscripcion->nombre == $diputado->circunscripcion())
                                <option value='{{ $circunscripcion->id }}' selected>
                                    {{ $circunscripcion->nombre }}
                                </option>
                            @else
                                <option value='{{ $circunscripcion->id }}'>
                                    {{ $circunscripcion->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="partido">Partido</label>
                    <select name="partido" id="partido" class="form-control">
                        @foreach ($partidos as $partido)
                            @if ($partido->nombre == $diputado->partido())
                                <option value='{{ $partido->id }}' selected>
                                    {{ $partido->nombre }}
                                </option>
                            @else
                                <option value='{{ $partido->id }}'>
                                    {{ $partido->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="fechacondicion">Fecha condicion plena</label>
                    <input type="date" class="form-control" name="fechacondicion" id="fechacondicion"
                        aria-describedby="fechacondicionHelp" placeholder="Introduzca fecha condicion plena"
                        value={{ $diputado->fechacondicionplena }}>
                </div>
                <div class="form-group">
                    <label for="fechaalta">Fecha alta</label>
                    <input type="date" class="form-control" name="fechaalta" id="fechaalta"
                        aria-describedby="fechaaltaHelp" placeholder="Introduzca fecha alta"
                        value={{ $diputado->fechaalta }}>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <select name="grupo" id="grupo" class="form-control">
                        @foreach ($grupos as $grupo)
                            @if ($grupo->nombre == $diputado->grupo())
                                <option value='{{ $grupo->id }}' selected>
                                    {{ $grupo->nombre }}
                                </option>
                            @else
                                <option value='{{ $grupo->id }}'>
                                    {{ $grupo->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea class="form-control" name="biografia" id="biografia"
                        rows="5">{{ $diputado->biografia }}</textarea>
                </div>


                <div class="row justify-content-md-center pb-2">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <div class="row justify-content-md-center pb-2">
                    <a href="{{ url()->previous() }}" type="button" class="col-6 btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
