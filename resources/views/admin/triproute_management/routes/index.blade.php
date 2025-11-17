@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2 class="mb-4">Routes</h2>

    <a href="{{ route('admin.routes.create') }}" class="btn btn-primary mb-3">
      Add New Route
    </a>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Name</th>
        <th>Start</th>
        <th>End</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach($routes as $route)
        <tr>
          <td>{{ $route->name }}</td>
          <td>{{ $route->start_location }}</td>
          <td>{{ $route->end_location }}</td>
          <td>
            <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" class="d-inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Delete route?')">
                Delete
              </button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection
