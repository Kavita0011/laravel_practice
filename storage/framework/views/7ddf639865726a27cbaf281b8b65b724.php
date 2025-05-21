 

<?php $__env->startSection('title', 'Create Member'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-success text-white">
      <h3>Create New Member</h3>
    </div>
    <div class="card-body">
      <?php if($errors->any()): ?>
        <div class="alert alert-danger">
          <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form action="<?php echo e(route('dashboard.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control" required value="<?php echo e(old('name')); ?>">
        </div>

        <div class="mb-3">
          <label for="medicaid_id" class="form-label">Medicaid ID</label>
          <input type="text" name="medicaid_id" id="medicaid_id" class="form-control" required value="<?php echo e(old('medicaid_id')); ?>">
        </div>

        <button type="submit" class="btn btn-primary">Create Member</button>
        <a href="<?php echo e(route('dashboard.memberslist')); ?>" class="btn btn-secondary">Back to List</a>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\OneDrive\Desktop\EverGreen Brain\laravel_practice\laravel\resources\views/dashboard/createmember.blade.php ENDPATH**/ ?>