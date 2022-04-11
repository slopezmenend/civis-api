@extends ('layouts.frontend')

@section('content')
    <div class="card p-1 m-4">
        <div class="card-header">
            <h1>Detalle diputado {{ $diputado->id }}</h1>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="nombrec">Nombre completo</label>
                    <input type="text" class="form-control" id="nombrec" aria-describedby="nombrecHelp"
                        placeholder="Sin valor para nombre completo" value='{{ $diputado->nombrecompleto }}' readonly>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp"
                        placeholder="Sin valor para nombre" value='{{ $diputado->nombre }}' readonly>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" aria-describedby="apellidosHelp"
                        placeholder="Sin valor para apellidos" value='{{ $diputado->apellidos }}' readonly>
                </div>
                <div class="form-group">
                    <label for="circunscripcion">Circunscripción</label>
                    <input type="text" class="form-control" id="circunscripcion" aria-describedby="cirHelp"
                        placeholder="Sin valor para circunscripción" value='{{ $diputado->circunscripcion() }}' readonly>
                </div>
                <div class="form-group">
                    <label for="partido">Partido</label>
                    <input type="text" class="form-control" id="partido" aria-describedby="partidoHelp"
                        placeholder="Sin valor para partido" value='{{ $diputado->partido() }}' readonly>

                </div>
                <div class="form-group">
                    <label for="fechacondicion">Fecha condicion plena</label>
                    <input type="date" class="form-control" id="fechacondicion" aria-describedby="fechacondicionHelp"
                        placeholder="Sin valor para fecha condicion plena" value={{ $diputado->fechacondicionplena }}
                        readonly>
                </div>
                <div class="form-group">
                    <label for="fechaalta">Fecha alta</label>
                    <input type="date" class="form-control" id="fechaalta" aria-describedby="fechaaltaHelp"
                        placeholder="Sin valor para fecha alta" value={{ $diputado->fechaalta }} readonly>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control" id="grupo" aria-describedby="grupoHelp"
                        placeholder="Sin valor para grupo" value='{{ $diputado->grupo() }}' readonly>
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea class="form-control" id="biografia" rows="5" readonly>{{ $diputado->biografia }}</textarea>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <input type="text" class="form-control" id="sexo" aria-describedby="sexoHelp"
                        placeholder="Sin valor para sexo" value='{{ $sexo }}' readonly>
                </div>

                <div class="form-group">
                    <label for="estadocivil">Estado Civil</label>
                    <input type="text" class="form-control" id="estadocivil" aria-describedby="estadocivilHelp"
                        placeholder="Sin valor para estado civil" value='{{ $estadocivil }}' readonly>
                </div>

                <div class="form-group">
                    <label for="numero">Número diputado</label>
                    <input type="text" class="form-control" id="numero" aria-describedby="numeroHelp"
                        placeholder="Sin valor para numero" value='{{ $diputado->numero }}' readonly>
                </div>

                <div class="form-group">
                    <label for="urlperfil">URL Perfil</label>
                    <input type="text" class="form-control" id="urlperfil" aria-describedby="urlperfilHelp"
                        placeholder="Sin valor para urlperfil" value='{{ $diputado->urlperfil }}' readonly>
                </div>

                <div class="form-group">
                    <label for="urlfoto">URL Foto</label>
                    <input type="text" class="form-control" id="urlfoto" aria-describedby="urlfotoHelp"
                        placeholder="Sin valor para urlfoto" value='{{ $diputado->urlfoto }}' readonly>
                </div>

                <div class="form-group">
                    <label for="urlescaño">URL Escaño</label>
                    <input type="text" class="form-control" id="urlescaño" aria-describedby="urlescañoHelp"
                        placeholder="Sin valor para urlescaño" value='{{ $diputado->urlescaño }}' readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" aria-describedby="emailHelp"
                        placeholder="Sin valor para email" value='{{ $diputado->email }}' readonly>
                </div>

                <div class="form-group">
                    <label for="twitter">Twitter</label>
                    <input type="text" class="form-control" id="twitter" aria-describedby="twitterHelp"
                        placeholder="Sin valor para twitter" value='{{ $diputado->twitter }}' readonly>
                </div>

                <div class="form-group">
                    <label for="facebook">facebook</label>
                    <input type="text" class="form-control" id="facebook" aria-describedby="facebookHelp"
                        placeholder="Sin valor para facebook" value='{{ $diputado->facebook }}' readonly>
                </div>

                <div class="form-group">
                    <label for="instagram">Instagram</label>
                    <input type="text" class="form-control" id="instagram" aria-describedby="instagramHelp"
                        placeholder="Sin valor para instagram" value='{{ $diputado->instagram }}' readonly>
                </div>

                <div class="form-group">
                    <label for="youtube">Youtube</label>
                    <input type="text" class="form-control" id="youtube" aria-describedby="youtubeHelp"
                        placeholder="Sin valor para youtube" value='{{ $diputado->youtube }}' readonly>
                </div>

                <div class="form-group">
                    <label for="webpersonal">Web personal</label>
                    <input type="text" class="form-control" id="webpersonal" aria-describedby="webpersonalHelp"
                        placeholder="Sin valor para webpersonal" value='{{ $diputado->webpersonal }}' readonly>
                </div>

                <a href="{{ url()->previous() }}" type="button" class="btn btn-info">Volver</a>
            </form>
        </div>
    </div>
@endsection
