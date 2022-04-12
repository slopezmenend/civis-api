@extends ('layouts.frontend')

@section('content')
    <div class="card p-1 m-4">
        <div class="card-header">
            <h1>Editar diputado {{ $diputado->id }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('diputados.update', $diputado) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombreimp">Nombre Importado</label>
                    <input type="text" class="form-control" name="nombreimp" id="nombreimp" aria-describedby="nombrecHelp"
                        placeholder="Introduzca nombre completo" value='{{ $diputado_imp->nombre }}' readonly>
                </div>

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
                    <label for="circunscripcionimp">Circunscripción importada</label>
                    <input type="text" class="form-control" name="circunscripcionimp" id="circunscripcionimp"
                        aria-describedby="circunscripcionimpHelp" placeholder="Introduzca circunscripcion"
                        value='{{ $diputado_imp->circunscripcion }}' readonly>
                </div>
                <div class="form-group">
                    <label for="circunscripcion_id">Circunscripción</label>
                    <select name="circunscripcion_id" id="circunscripcion_id" class="form-control">
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
                    <label for="partidoimp">Partido importado</label>
                    <input type="text" class="form-control" name="partidoimp" id="partidoimp"
                        aria-describedby="partidoimpHelp" placeholder="Introduzca partido"
                        value='{{ $diputado_imp->formacionelectoral }}' readonly>
                </div>
                <div class="form-group">
                    <label for="partido_id">Partido</label>
                    <select name="partido_id" id="partido_id" class="form-control">
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
                    <label for="fechacondicionplenaimp">Fecha cond. plena importada</label>
                    <input type="date" class="form-control" name="fechacondicionplenaimp" id="fechacondicionplenaimp"
                        aria-describedby="fechacondicionplenaimpHelp" placeholder="Introduzca fecha condicion plena"
                        value='{{ $diputado_imp->fechacondicionplena }}' readonly>
                </div>
                <div class="form-group">
                    <label for="fechacondicionplena">Fecha condicion plena</label>
                    <input type="date" class="form-control" name="fechacondicionplena" id="fechacondicionplena"
                        aria-describedby="fechacondicionHelp" placeholder="Introduzca fecha condicion plena"
                        value={{ $diputado->fechacondicionplena }}>
                </div>
                <div class="form-group">
                    <label for="fechaaltaimp">Fecha alta importada</label>
                    <input type="date" class="form-control" name="fechaaltaimp" id="fechaaltaimp"
                        aria-describedby="fechaaltaimpHelp" placeholder="Introduzca fecha alta"
                        value={{ $diputado_imp->fechaalta }} readonly>
                </div>
                <div class="form-group">
                    <label for="fechaalta">Fecha alta</label>
                    <input type="date" class="form-control" name="fechaalta" id="fechaalta"
                        aria-describedby="fechaaltaHelp" placeholder="Introduzca fecha alta"
                        value={{ $diputado->fechaalta }}>
                </div>
                <div class="form-group">
                    <label for="grupoimp">Grupo importado</label>
                    <input type="text" class="form-control" name="grupoimp" id="grupoimp" aria-describedby="grupoimpHelp"
                        placeholder="Introduzca grupo" value={{ $diputado_imp->grupoparlamentario }} readonly>
                </div>
                <div class="form-group">
                    <label for="grupo_id">Grupo</label>
                    <select name="grupo_id" id="grupo_id" class="form-control">
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
                    <label for="biografiaimp">Biografía importada</label>
                    <textarea class="form-control" name="biografiaimp" id="biografiaimp" rows="5"
                        readonly>{{ $diputado_imp->biografia }}</textarea>
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea class="form-control" name="biografia" id="biografia" rows="5">{{ $diputado->biografia }}</textarea>
                </div>

                <div class="form-group">
                    <label for="sexo_id">Sexo</label>
                    <select name="sexo_id" id="sexo_id" class="form-control">
                        @if ($diputado->sexo_id == null)
                            <option value='null' selected>

                            </option>
                        @endif
                        @foreach ($sexos as $sexo)
                            @if ($sexo->id == $diputado->sexo_id)
                                <option value='{{ $sexo->id }}' selected>
                                    {{ $sexo->nombre }}
                                </option>
                            @else
                                <option value='{{ $sexo->id }}'>
                                    {{ $sexo->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="estadocivil_id">Estado Civil</label>
                    <select name="estadocivil_id" id="estadocivil_id" class="form-control">
                        @if ($diputado->estadocivil_id == null)
                            <option value='null' selected>

                            </option>
                        @endif
                        @foreach ($estadosciviles as $estadocivil)
                            @if ($estadocivil->id == $diputado->estadocivil_id)
                                <option value='{{ $estadocivil->id }}' selected>
                                    {{ $estadocivil->nombre }}
                                </option>
                            @else
                                <option value='{{ $estadocivil->id }}'>
                                    {{ $estadocivil->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="numeroimp">Número diputado importado</label>
                    <input type="text" class="form-control" name="numeroimp" id="numeroimp" aria-describedby="numeroHelp"
                        placeholder="Introduzca numero" value='{{ $diputado_imp->numero }}' readonly>
                </div>

                <div class="form-group">
                    <label for="numero">Número diputado</label>
                    <input type="text" class="form-control" name="numero" id="numero" aria-describedby="numeroHelp"
                        placeholder="Introduzca numero" value='{{ $diputado->numero }}'>
                </div>

                <div class="form-group">
                    <label for="urlperfilimp">URL perfil importada</label>
                    <input type="text" class="form-control" name="urlperfilimp" id="urlperfilimp"
                        aria-describedby="urlperfilHelp" placeholder="Introduzca url perfil"
                        value='{{ $diputado_imp->urlperfil }}' readonly>
                </div>

                <div class="form-group">
                    <label for="urlperfil">URL perfil</label>
                    <input type="text" class="form-control" name="urlperfil" id="urlperfil"
                        aria-describedby="urlperfilHelp" placeholder="Introduzca urlperfil"
                        value='{{ $diputado->urlperfil }}'>
                </div>

                <div class="form-group">
                    <label for="urlfotoimp">URL foto importada</label>
                    <input type="text" class="form-control" name="urlfotoimp" id="urlfotoimp"
                        aria-describedby="urlfotoHelp" placeholder="Introduzca url foto"
                        value='{{ $diputado_imp->urlfoto }}' readonly>
                </div>

                <div class="form-group">
                    <label for="urlfoto">URL foto</label>
                    <input type="text" class="form-control" name="urlfoto" id="urlfoto" aria-describedby="urlfotoHelp"
                        placeholder="Introduzca urlfoto" value='{{ $diputado->urlfoto }}'>
                </div>

                <div class="form-group">
                    <label for="urlescañoimp">URL escaño importada</label>
                    <input type="text" class="form-control" name="urlescañoimp" id="urlescañoimp"
                        aria-describedby="urlescañoHelp" placeholder="Introduzca url escaño"
                        value='{{ $diputado_imp->urlescaño }}' readonly>
                </div>

                <div class="form-group">
                    <label for="urlescaño">URL Escaño</label>
                    <input type="text" class="form-control" name="urlescaño" id="urlescaño"
                        aria-describedby="urlescañoHelp" placeholder="Introduzca urlescaño"
                        value='{{ $diputado->urlescaño }}'>
                </div>

                <div class="form-group">
                    <label for="emailimp">Email importado</label>
                    <input type="text" class="form-control" name="emailimp" id="emailimp" aria-describedby="emailimpHelp"
                        placeholder="Introduzca Email" value='{{ $diputado_imp->email }}' readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="emailHelp"
                        placeholder="Introduzca email" value='{{ $diputado->email }}'>
                </div>

                <div class="form-group">
                    <label for="twitterimp">Twitter importado</label>
                    <input type="text" class="form-control" name="twitterimp" id="twitterimp"
                        aria-describedby="twitterimpHelp" placeholder="Introduzca twitter"
                        value='{{ $diputado_imp->twitter }}' readonly>
                </div>

                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" name="twitter" id="twitter" aria-describedby="twitterHelp"
                        placeholder="Introduzca twitter" value='{{ $diputado->twitter }}'>
                </div>

                <div class="form-group">
                    <label for="facebookimp">Facebook importado</label>
                    <input type="text" class="form-control" name="facebookimp" id="facebookimp"
                        aria-describedby="facebookimpHelp" placeholder="Introduzca facebook"
                        value='{{ $diputado_imp->facebook }}' readonly>
                </div>

                <div class="form-group">
                    <label for="facebook">facebook</label>
                    <input type="text" class="form-control" name="facebook" id="facebook" aria-describedby="facebookHelp"
                        placeholder="Introduzca facebook" value='{{ $diputado->facebook }}'>
                </div>

                <div class="form-group">
                    <label for="instagramimp">Instagram importado</label>
                    <input type="text" class="form-control" name="instagramimp" id="instagramimp"
                        aria-describedby="instagramimpHelp" placeholder="Introduzca instagram"
                        value='{{ $diputado_imp->instagram }}' readonly>
                </div>

                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" name="instagram" id="instagram"
                        aria-describedby="instagramHelp" placeholder="Introduzca instagram"
                        value='{{ $diputado->instagram }}'>
                </div>

                <div class="form-group">
                    <label for="youtubeimp">Youtube importado</label>
                    <input type="text" class="form-control" name="youtubeimp" id="youtubeimp"
                        aria-describedby="youtubeimpHelp" placeholder="Introduzca youtube"
                        value='{{ $diputado_imp->youtube }}' readonly>
                </div>

                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" name="youtube" id="youtube" aria-describedby="youtubeHelp"
                        placeholder="Introduzca youtube" value='{{ $diputado->youtube }}'>
                </div>

                <div class="form-group">
                    <label for="webpersonalimp">Web personal importada</label>
                    <input type="text" class="form-control" name="webpersonalimp" id="webpersonalimp"
                        aria-describedby="webpersonalimpHelp" placeholder="Introduzca web personal"
                        value='{{ $diputado_imp->webpersonal }}' readonly>
                </div>

                <div class="form-group">
                    <label for="webpersonal">Web personal</label>
                    <input type="text" class="form-control" name="webpersonal" id="webpersonal"
                        aria-describedby="webpersonalHelp" placeholder="Introduzca webpersonal"
                        value='{{ $diputado->webpersonal }}'>
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
