@extends('layouts.app')

@section('content')
  <h1>Routes</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('admin.routes.create') }}" class="btn btn-success mb-3">Add Route</a>

  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Route Name</th>
      <th>Origin</th>
      <th>Destination</th>
      <th>Distance (km)</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($routes as $route)
      <tr>
        <td>{{ $route->route_name }}</td>
        <td>{{ $route->origin }}</td>
        <td>{{ $route->destination }}</td>
        <td>{{ $route->distance_km ?? '-' }}</td>
        <td>{{ ucfirst($route->status) }}</td>
        <td>
          <a href="{{ route('admin.routes.edit', $route->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.routes.destroy', $route->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
