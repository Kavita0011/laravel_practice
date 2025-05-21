

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
  <div class="container-fluid">
    <h1 class="mb-3">Dashboard</h1>
    <p>Welcome to Admin Panel powered by AdminLTE.</p>

    <div id="dashboard-data" class="mt-4 alert alert-info">
      Loading user data...
    </div>
  </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\OneDrive\Desktop\EverGreen Brain\laravel_practice\laravel\resources\views/dashboard/index.blade.php ENDPATH**/ ?>