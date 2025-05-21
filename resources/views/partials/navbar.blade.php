<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav me-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
      <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <span id="user-name"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
      </div>
    </li>
  </ul>
</nav>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const userData = localStorage.getItem('user');
    if (userData) {
      try {
        const user = JSON.parse(userData);
        document.getElementById('user-name').textContent = user.name || 'User';
      } catch (e) {
        console.error('Error parsing user data from localStorage', e);
        document.getElementById('user-name').textContent = 'User';
      }
    } else {
      document.getElementById('user-name').textContent = 'User';
    }
  });
    function logout() {
    localStorage.clear();
    window.location.href = '/login'; // Redirect to login page
  }
</script>
