

<?php $__env->startSection('content'); ?>
<h1>Bienvenido usuario</h1>
	
  <div class="rounded-sm border-info bg-white mb-1 grupo">
  <h4>Diputados</h4>
    
  <div class="card-group text-primary">
    <div class="card card-w">
    <a href="#" class="text-decoration-none">  
      <div class="card-body">
        <h5 class="card-title">Estado</h5>
        <p class="card-text"><div><span>Diputados cargados: </span><span>351</span><span>Diputados en revisión: </span><span>22</span></div></p>
  
        <p class="card-text">Haga click para acceder al log.</p>
      </div>
    </a>
    </div>
    
    <div class="card text-muted card-w">
      <div class="card-body">
        <h5 class="card-title">Importar</h5>
        <p class="card-text">Se están importando los diputados:</p>
  <div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
  </div>
      </div>
    </div>
    
     <div class="card text-muted card-w">
      <div class="card-body">
        <h5 class="card-title">Pendientes de revisar</h5>
        <p class="card-text">Proceso bloqueado debido a una operación de importar en ejecución.</p>
        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por usuario</small></p>
      </div>
    </div>
      <div class="card card-w">
    <a href="#" class="text-decoration-none">
      <div class="card-body">
        <h5 class="card-title">Listado diputados</h5>
        <p class="card-text">Haga click sobre esta tarjeta para ejecutar el listado/detalle de diputados.</p>
      </div>
    </a>
    </div>
  </div>
  </div>
  
  <div class="rounded-sm border-info bg-white mb-1 grupo">
  <h4>Diputados</h4>
    
  <div class="card-group">
    <div class="card">
    <a href="#" class="text-decoration-none">
      <div class="card-body">
        <h5 class="card-title">Importar</h5>
        <p class="card-text">Haga click sobre esta tarjeta para programar la ejecución del importado de diputados.</p>
        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por usuario</small></p>
      </div>
    </a>
    </div>
     <div class="card">
    <a href="#" class="text-decoration-none">
      <div class="card-body">
        <h5 class="card-title">Pendientes de revisar</h5>
        <p class="card-text">Haga click sobre esta tarjeta para abrir la revisión de diputados pendientes de confirmación.</p>
        <p class="card-text"><small class="text-muted">Última ejecución el 02/03/2022 por usuario</small></p>
      </div>
    </a>
    </div>
      <div class="card">
    <a href="#" class="text-decoration-none">
      <div class="card-body">
        <h5 class="card-title">Listado diputados</h5>
        <p class="card-text">Haga click sobre esta tarjeta para ejecutar el listado/detalle de diputados.</p>
      </div>
    </a>
    </div>
  </div>
  </div>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp2\htdocs\slopezmenend\Civis\civis\resources\views/pages/diputados/importar.blade.php ENDPATH**/ ?>