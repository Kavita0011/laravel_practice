 

<?php $__env->startSection('title', 'Member List'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h3 class="card-title">Member List</h3>
    </div>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="m-3">Member List</h3>
  <a href="<?php echo e(route('dashboard.createmember')); ?>" class="btn btn-success m-2">+ Add Member</a>
</div>
    <div class="card-body table-responsive">
      <?php if($members->count()): ?>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Medicaid ID</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($index + 1); ?></td>
            <td><?php echo e($member->name); ?></td>
            <td><?php echo e($member->medicaid_id); ?></td>
            <td>
              <a href="<?php echo e(route('dashboard.update', $member->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
              <form action="<?php echo e(route('dashboard.destroy', $member->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
      <?php else: ?>
        <p class="text-muted">No members found.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem("token") 
    // || '13|jq8K0eYmeWhRdqpYj6Wdokwpetb2uAI1PhY9ajhj62f3e0a1';

    fetch("http://127.0.0.1:8000/dashboard/members", {
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

<?php echo $__env->make('admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\OneDrive\Desktop\EverGreen Brain\laravel_practice\laravel\resources\views/dashboard/memberslist.blade.php ENDPATH**/ ?>