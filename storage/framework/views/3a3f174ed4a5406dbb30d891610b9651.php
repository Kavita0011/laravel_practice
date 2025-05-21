<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- AdminLTE CSS -->
  <link href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
  <link href="<?php echo e(asset('adminlte/dist/css/adminlte.min.css')); ?>" rel="stylesheet">
  
  <?php echo $__env->yieldContent('styles'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- Sidebar -->
  <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- Content -->
  <div class="content-wrapper">
    <section class="content p-3">
      <?php echo $__env->yieldContent('content'); ?>
    </section>
  </div>

  <!-- Footer -->
  <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

<!-- Scripts -->
<script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/dist/js/adminlte.min.js')); ?>"></script>
<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
<?php /**PATH C:\Users\LENOVO\OneDrive\Desktop\EverGreen Brain\laravel_practice\laravel\resources\views/admin.blade.php ENDPATH**/ ?>