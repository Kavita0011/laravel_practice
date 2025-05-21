 

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
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem("token") 
    // || '13|jq8K0eYmeWhRdqpYj6Wdokwpetb2uAI1PhY9ajhj62f3e0a1';

    fetch("http://127.0.0.1:8000/dashboard/createmembers", {
      method: "GET",
      headers: {
        "Authorization": `Bearer ${token}`,
        "Accept": "application/json"
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error("Token expired or unauthorized");
      }
      return response.json();
    })
    .then(data => {
      document.getElementById("user-name").innerText = data.user.name;
    })
    .catch(err => {
      alert(err.message);
    //   localStorage.removeItem("token");
    //   window.location.href = "/api/login"; // adjust if your login route is different
    });
  });

  function logout() {
    localStorage.removeItem("token");
    window.location.href = "/api/login";
  }
</script>

<?php echo $__env->make('admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\OneDrive\Desktop\EverGreen Brain\laravel_practice\laravel\resources\views/dashboard/createmember.blade.php ENDPATH**/ ?>