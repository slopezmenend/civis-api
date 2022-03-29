<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h1>Civis API Dashboard - Consulta diputados</h1>
        </div>
        <div class="card-body">
            <form action="/update-diputado/<?php echo e($diputado->id); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="nombrec">Nombre completo</label>
                    <input type="text" class="form-control" id="nombrec" aria-describedby="nombrecHelp"
                        placeholder="Introduzca nombre completo" value='<?php echo e($diputado->nombrecompleto); ?>'>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp"
                        placeholder="Introduzca nombre" value='<?php echo e($diputado->nombre); ?>'>
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" aria-describedby="apellidosHelp"
                        placeholder="Introduzca apellidos" value='<?php echo e($diputado->apellidos); ?>'>
                </div>
                <div class="form-group">
                    <label for="circunscripcion">Circunscripción</label>
                    <select id="circunscripcion" class="form-control">
                        <?php $__currentLoopData = $circunscripciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circunscripcion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($circunscripcion->nombre == $diputado->circunscripcion()): ?>
                                <option value='<?php echo e($circunscripcion->nombre); ?>' selected>
                                    <?php echo e($circunscripcion->nombre); ?>

                                </option>
                            <?php else: ?>
                                <option value='<?php echo e($circunscripcion->nombre); ?>'>
                                    <?php echo e($circunscripcion->nombre); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="partido">Partido</label>
                    <select id="partido" class="form-control">
                        <?php $__currentLoopData = $partidos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partido): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($partido->nombre == $diputado->partido()): ?>
                                <option value='<?php echo e($partido->nombre); ?>' selected>
                                    <?php echo e($partido->nombre); ?>

                                </option>
                            <?php else: ?>
                                <option value='<?php echo e($partido->nombre); ?>'>
                                    <?php echo e($partido->nombre); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fechacondicion">Fecha condicion plena</label>
                    <input type="date" class="form-control" id="fechacondicion" aria-describedby="fechacondicionHelp"
                        placeholder="Introduzca fecha condicion plena" value=<?php echo e($diputado->fechacondicionplena); ?>>
                </div>
                <div class="form-group">
                    <label for="fechaalta">Fecha alta</label>
                    <input type="date" class="form-control" id="fechaalta" aria-describedby="fechaaltaHelp"
                        placeholder="Introduzca fecha alta" value=<?php echo e($diputado->fechaalta); ?>>
                </div>
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <select id="grupo" class="form-control">
                        <?php $__currentLoopData = $grupos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grupo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($grupo->nombre == $diputado->grupo()): ?>
                                <option value='<?php echo e($grupo->nombre); ?>' selected>
                                    <?php echo e($grupo->nombre); ?>

                                </option>
                            <?php else: ?>
                                <option value='<?php echo e($grupo->nombre); ?>'>
                                    <?php echo e($grupo->nombre); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="biografia">Biografia</label>
                    <textarea class="form-control" id="biografia" rows="5"><?php echo e($diputado->biografia); ?></textarea>
                </div>
                <!--<a href="/diputado/<?php echo e($diputado->id); ?>" type="button" class="btn btn-info">Guardar</a>-->
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>

                <a href="<?php echo e(url()->previous()); ?>" type="button" class="btn btn-info">Volver</a>
            </form>
        </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/diputados/editar.blade.php ENDPATH**/ ?>