<?php $__env->startSection('content'); ?>
    <h1>Civis API Dashboard</h1>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Diputados</h4>

        <div class="card-group text-primary">
            <div class="card">
                <a href="./diputados/log/index.html" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title ">Estado</h5>
                        <p class="card-text">
                        <div><span>Diputados cargados: </span><span>351</span><span>Diputados en revisión:
                            </span><span>22</span></div>
                        </p>

                        <p class="card-text">Haga click para acceder al log.</p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="/diputados/importar/" class="text-decoration-none" aria-disabled="true">
                    <div class="card-body">
                        <h5 class="card-title">Importar</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para programar la ejecución del importado de
                            diputados.</p>
                        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por
                                usuario</small></p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="./diputados/revisar/" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Pendientes de revisar</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para abrir la revisión de diputados
                            pendientes de confirmación.</p>
                        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por
                                usuario</small></p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="/diputados/" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Listado diputados</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para ejecutar el listado/detalle de
                            diputados.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Votaciones</h4>

        <div class="card-group text-primary">
            <div class="card">
                <a href="./votaciones/log/index.html" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Estado</h5>
                        <p class="card-text">
                        <div><span>Sesiones: </span><span>351</span><span>Votaciones: </span><span>22</span><span>Votos:
                            </span><span>22</span></div>
                        </p>

                        <p class="card-text">Haga click para acceder al log.</p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="/votaciones/importar/" class="text-decoration-none" aria-disabled="true">
                    <div class="card-body">
                        <h5 class="card-title">Importar</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para programar la ejecución del importado de
                            votaciones.</p>
                        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por
                                usuario</small></p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="/votaciones/" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Listado votaciones</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para ejecutar el listado/detalle de
                            votaciones.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="rounded-sm border-info bg-white mb-1 grupo">
        <h4>Intervenciones</h4>

        <div class="card-group text-primary">
            <div class="card">
                <a href="./intervenciones/log/index.html" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Estado</h5>
                        <p class="card-text">
                        <div><span>Intervenciones cargadas: </span><span>6000</span></div>
                        </p>

                        <p class="card-text">Haga click para acceder al log.</p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="./intervenciones/importar/index.html" class="text-decoration-none" aria-disabled="true">
                    <div class="card-body">
                        <h5 class="card-title">Importar</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para programar la ejecución del importado de
                            intervenciones.</p>
                        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por
                                usuario</small></p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="./intervenciones/revisar" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Pendientes de completar</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para abrir la revisión de intervenciones
                            pendientes de tareas manuales.</p>
                        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por
                                usuario</small></p>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="./intervenciones/" class="text-decoration-none">
                    <div class="card-body">
                        <h5 class="card-title">Listado intervenciones</h5>
                        <p class="card-text">Haga click sobre esta tarjeta para ejecutar el listado/detalle de
                            intervenciones.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/index.blade.php ENDPATH**/ ?>