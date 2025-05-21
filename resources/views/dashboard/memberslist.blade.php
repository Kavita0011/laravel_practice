@extends('admin') {{-- Or your layout file --}}

@section('title', 'Member List')

@section('content')
<div class="container-fluid mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h3 class="card-title">Member List</h3>
    </div>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3 class="m-3">Member List</h3>
  <a href="{{ route('dashboard.createmember') }}" class="btn btn-success m-2">+ Add Member</a>
</div>
    <div class="card-body table-responsive">
      @if($members->count())
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
          @foreach($members as $index => $member)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $member->name }}</td>
            <td>{{ $member->medicaid_id }}</td>
            <td>
              <a href="{{ route('dashboard.update', $member->id) }}" class="btn btn-sm btn-warning">Edit</a>
              <form action="{{ route('dashboard.destroy', $member->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <p class="text-muted">No members found.</p>
      @endif
    </div>
  </div>
</div>
@endsection

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
