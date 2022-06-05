@extends ('layouts.frontend')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Listado de EPs de la API</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped w-100">
                    <thead>
                        <tr class="table-info">
                            <th scope="col">#</th>
                            <th scope="col">EP</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>/login</td>
                            <td>POST</td>
                            <td>Petición que recibe como parámetros 'name', 'password' y 'password_confirmation' y nos
                                devuelve el token de autentificación que será usado en el resto de peticiones.</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>/diputados</td>
                            <td>GET</td>
                            <td>Listado general de los diputados con sus datos.</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>/diputado/{id}</td>
                            <td>GET</td>
                            <td>Consulta del detalle de un diputado usando su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>/votaciones</td>
                            <td>GET</td>
                            <td>Listado general de votaciones con sus datos.</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>/votaciones/date/{date}</td>
                            <td>GET</td>
                            <td>Listado de votaciones de una fecha concreta que se enviará en formato aaaa-mm-dd.</td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>/votaciones/diputado/{id}</td>
                            <td>GET</td>
                            <td>Listado de votos de un diputado concreto indicando el 'id' de dicho diputado.</td>
                        </tr>
                        <tr>
                            <th scope="row">7</th>
                            <td>/votacion/{id}</td>
                            <td>GET</td>
                            <td>Consulta del detalle de una votación concreta indicando su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">8</th>
                            <td>/votacion/votos/{id}</td>
                            <td>GET</td>
                            <td>Listdo de votos de una votación concreta indicando su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">9</th>
                            <td>/intervenciones</td>
                            <td>GET</td>
                            <td>Listado general de intervenciones.</td>
                        </tr>
                        <tr>
                            <th scope="row">10</th>
                            <td>/intervenciones/date/{date}</td>
                            <td>GET</td>
                            <td>Listado de las intervenciones de una fecha concreta indicada en formato aaaa-mm-dd.</td>
                        </tr>
                        <tr>
                            <th scope="row">11</th>
                            <td>/intervenciones/diputado/{id}</td>
                            <td>GET</td>
                            <td>Listado de las intervenciones de un diputado concreto indicando el 'id' del mismo.</td>
                        </tr>
                        <tr>
                            <th scope="row">12</th>
                            <td>/intervencion/{id}</td>
                            <td>GET</td>
                            <td>Consulta del detalle de una intervencion concreta por su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">13</th>
                            <td>/circunscripciones</td>
                            <td>GET</td>
                            <td>Listado general de circunscripciones.</td>
                        </tr>
                        <tr>
                            <th scope="row">14</th>
                            <td>/circunscripcion/{id}</td>
                            <td>GET</td>
                            <td>Detalle de circunscripción consultado por su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">15</th>
                            <td>/grupos</td>
                            <td>GET</td>
                            <td>Listado general de grupos parlamentarios.</td>
                        </tr>
                        <tr>
                            <th scope="row">16</th>
                            <td>/grupo/{id}</td>
                            <td>GET</td>
                            <td>Detalle de grupo parlamentario consultado por su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">17</th>
                            <td>/partidos</td>
                            <td>GET</td>
                            <td>Listado general de partidos.</td>
                        </tr>
                        <tr>
                            <th scope="row">18</th>
                            <td>/partido/{id}</td>
                            <td>GET</td>
                            <td>Detalle de partido consultado por su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">19</th>
                            <td>/sexos</td>
                            <td>GET</td>
                            <td>Listado general de sexos.</td>
                        </tr>
                        <tr>
                            <th scope="row">20</th>
                            <td>/sexo/{id}</td>
                            <td>GET</td>
                            <td>Detalle de sexo consultado por su 'id'.</td>
                        </tr>
                        <tr>
                            <th scope="row">21</th>
                            <td>/estadosciviles</td>
                            <td>GET</td>
                            <td>Listado general de estados civiles.</td>
                        </tr>
                        <tr>
                            <th scope="row">22</th>
                            <td>/estadocivil/{id}</td>
                            <td>GET</td>
                            <td>Detalle de estado civil consultado por su 'id'.</td>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-md-center pb-2">
                    <a href="{{ url()->previous() }}" type="button" class="col-6 btn btn-info">Volver</a>
                </div>
            </diV>
        </div>
    </div>
@endsection
