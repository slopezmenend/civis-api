<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h1>Civis API Dashboard - Consulta diputados</h1>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="nombrec">Nombre completo</label>
                    <input type="text" class="form-control" id="nombrec" aria-describedby="nombrecHelp"
                        placeholder="Introduzca nombre completo" value='<?php echo e($diputado->nombrecompleto); ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp"
                        placeholder="Introduzca nombre" value='<?php echo e($diputado->nombre); ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" aria-describedby="apellidosHelp"
                        placeholder="Introduzca apellidos" value='<?php echo e($diputado->apellidos); ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="circunscripcion">Circunscripción</label>
                    <input type="text" class="form-control" id="circunscripcion" aria-describedby="cirHelp"
                        placeholder="Introduzca circunscripción" value='<?php echo e($diputado->circunscripcion()); ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="partido">Partido</label>
                    <input type="text" class="form-control" id="partido" aria-describedby="partidoHelp"
                        placeholder="Introduzca partido" value='<?php echo e($diputado->partido()); ?>' readonly>

                </div>
                <div class="form-group">
                    <label for="fechacondicion">Fecha condicion plena</label>
                    <input type="date" class="form-control" id="fechacondicion" aria-describedby="fechacondicionHelp"
                        placeholder="Introduzca fecha condicion plena" value=<?php echo e($diputado->fechacondicionplena); ?>

                        readonly>
                </div>
                <div class="form-group">
                    <label for="fechaalta">Fecha alta</label>
                    <input type="date" class="form-control" id="fechaalta" aria-describedby="fechaaltaHelp"
                        placeholder="Introduzca fecha alta" value=<?php echo e($diputado->fechaalta); ?> readonly>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control" id="grupo" aria-describedby="grupoHelp"
                        placeholder="Introduzca grupo" value='<?php echo e($diputado->grupo()); ?>' readonly>
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea class="form-control" id="biografia" rows="5"
                        readonly><?php echo e($diputado->biografia); ?></textarea>
                </div>
        </div>

        <a href="<?php echo e(url()->previous()); ?>" type="button" class="btn btn-info">Volver</a>
        </form>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/diputados/detalle.blade.php ENDPATH**/ ?>