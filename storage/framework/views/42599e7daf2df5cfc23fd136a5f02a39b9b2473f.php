<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h1>Civis API Dashboard - Consulta votaciones</h1>
        </div>
        <div class="card-body p-5">
            <form>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label for="sesion" class="font-weight-bold">Sesion</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="sesion" aria-describedby="sesionHelp"
                            placeholder="Introduzca sesion" value="<?php echo e($votacion->sesion); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="votacion">Votación</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="votacion" aria-describedby="votacionHelp"
                            placeholder="Introduzca votacion" value="<?php echo e($votacion->numeroVotacion); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="fecha">Fecha</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" id="fecha" aria-describedby="fechaHelp"
                            placeholder="Introduzca fecha" value="<?php echo e($votacion->fecha); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="titulo">Título</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="titulo" aria-describedby="tituloHelp"
                            placeholder="Introduzca titulo" value="<?php echo e($votacion->titulo); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="presentes">Presentes</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="presentes" aria-describedby="presentesHelp"
                            placeholder="Introduzca presentes" value="<?php echo e($votacion->presentes); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="afavor">A favor</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="afavor" aria-describedby="afavorHelp"
                            placeholder="Introduzca afavor" value="<?php echo e($votacion->afavor); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="encontra">En contra</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="encontra" aria-describedby="encontraHelp"
                            placeholder="Introduzca encontra" value="<?php echo e($votacion->enContra); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="abstenciones">Abstenciones</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="abstenciones" aria-describedby="abstencionesHelp"
                            placeholder="Introduzca abstenciones" value="<?php echo e($votacion->abstenciones); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-1 pl-1">
                        <label class="font-weight-bold" for="novotan">No votan</label>
                    </div>
                    <div class="col">
                        <input type="number" class="form-control" id="novotan" aria-describedby="novotanHelp"
                            placeholder="Introduzca novotan" value="<?php echo e($votacion->noVotan); ?>" readonly>
                    </div>
                </div>
                <div class="row justify-content-md-center pb-2">
                    <a href="/votacion/votos/<?php echo e($votacion->id); ?>" type="button" class="col-6 btn btn-info">Ver Detalle</a>
                </div>
                <div class="row justify-content-md-center pb-2">
                    <a href="/votaciones/" type="button" class="col-6 btn btn-info">Volver</a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/votaciones/detalle.blade.php ENDPATH**/ ?>