@extends('admin') {{-- Replace with your actual layout if different --}}

@section('title', 'Create Member')

@section('content')
<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-success text-white">
      <h3>Create New Member</h3>
    </div>
    <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('dashboard.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
          <label for="medicaid_id" class="form-label">Medicaid ID</label>
          <input type="text" name="medicaid_id" id="medicaid_id" class="form-control" required value="{{ old('medicaid_id') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create Member</button>
        <a href="{{ route('dashboard.memberslist') }}" class="btn btn-secondary">Back to List</a>
      </form>
    </div>
  </div>
</div>
@endsection
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
