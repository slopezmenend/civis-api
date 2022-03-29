<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h1>Civis API Dashboard - Consulta votaciones</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped ">
                <thead>
                    <tr class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">Sesión</th>
                        <th scope="col">Votación</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Aprobado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $votaciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $votacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($votacion->id); ?></th>
                            <td><?php echo e($votacion->sesion); ?></td>
                            <td><?php echo e($votacion->numeroVotacion); ?></td>
                            <td><?php echo e($votacion->fecha); ?></td>
                            <td><?php echo e($votacion->titulo); ?></td>
                            <?php if($votacion->aprobada()): ?>
                                <td>Sí</td>
                            <?php else: ?>
                                <td>No</td>
                            <?php endif; ?>
                            <td class="col-2"><a href="/votacion/<?php echo e($votacion->id); ?>" type="button"
                                    class="btn btn-info">Visualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link active" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/votaciones/index.blade.php ENDPATH**/ ?>