<?php $__env->startSection('content'); ?>
    <div class="card m-4">
        <div class="card-header">
            <h4>Listado Diputados</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Circunscripción</th>
                        <th scope="col">Partido</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $diputados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $diputado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th scope="row"><?php echo e($diputado->id); ?></th>
                            <td><?php echo e($diputado->nombre); ?></td>
                            <td><?php echo e($diputado->circunscripcion()); ?></td>
                            <td><?php echo e($diputado->partido()); ?></td>
                            <td>
                                <a href="/diputado/<?php echo e($diputado->id); ?>" type="button" class="btn btn-primary">Ver
                                    detalle</a>
                                <a href="/editar-diputado/<?php echo e($diputado->id); ?>" type="button"
                                    class="btn btn-primary">Editar</a>
                                <a href="/borrar-diputado/<?php echo e($diputado->id); ?>" type="button"
                                    class="btn btn-danger">Eliminar</a>
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

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/diputados/index.blade.php ENDPATH**/ ?>