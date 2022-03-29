<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h1>Civis API Dashboard - Consulta votos - Votación <?php echo e($votacion); ?></h1>
        </div>
        <div class="card-body">
            <div class="row justify-content-md-left pb-2">
                <a href="<?php echo e(url()->previous()); ?>" type="button" class="col-2 btn btn-info">Volver</a>
            </div>
            <table class="table table-striped ">
                <thead>
                    <tr class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">Diputado</th>
                        <th scope="col">Partido</th>
                        <th scope="col">Voto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $votos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td scope="row"><?php echo e($voto->id); ?></td>
                            <td><?php echo e($voto->diputado()->nombrecompleto); ?></td>
                            <td><?php echo e($voto->diputado()->partido()); ?></td>
                            <td><?php echo e($voto->voto); ?></td>
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

<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/votaciones/votos.blade.php ENDPATH**/ ?>