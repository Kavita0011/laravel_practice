@extends('admin')

@section('title', 'Dashboard')

@section('content')
  <div class="container-fluid">
    <h1 class="mb-3">Dashboard</h1>
    <p>Welcome to Admin Panel powered by AdminLTE.</p>

    <div id="dashboard-data" class="mt-4 alert alert-info">
      Loading user data...
    </div>
    <div class="mt-4">
      <button class="btn btn-danger" onclick="logout()"><a href={{route('logout')}}>Logout</a></button>
  </div>
@endsection
@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      fetchUserData();
    });

    function fetchUserData() {
      fetch('/dashboard/members', {
          method: 'GET',
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`,
            // 'Accept': 'application/json'
          }
        })
        .then(response => response.json())
        .then(data => {
          const dashboardData = document.getElementById('dashboard-data');
          dashboardData.innerHTML = `
            <strong>User Name:</strong> ${data.name} <br>
            <strong>Email:</strong> ${data.email}
          `;
        })
        .catch(error => {
          console.log('Error fetching user data:', error);
        });
    }
  document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem("token") 
    // || '13|jq8K0eYmeWhRdqpYj6Wdokwpetb2uAI1PhY9ajhj62f3e0a1';

    fetch("http://127.0.0.1:8000/dashboard", {
      method: "GET",
      headers: {
        "Authorization": `Bearer ${token}`,
        // "Accept": "application/json"
      }
    })
    .then(response => {
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
    localStorage.removeItem("user");
    window.location.href =route('logout');
  }
</script>

@endsection