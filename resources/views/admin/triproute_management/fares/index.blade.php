@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Fare Management</h2>

    <a href="{{ route('admin.fares.create') }}" class="btn btn-primary mb-3">Add Fare</a>

    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Route</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
      </thead>

      <tbody>
      @foreach($fares as $fare)
        <tr>
          <td>{{ $fare->route_id }}</td>
          <td>{{ $fare->price }}</td>
          <td>
            <a href="{{ route('admin.fares.edit', $fare->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('admin.fares.destroy', $fare->id) }}" class="d-inline" method="POST">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Delete fare?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>

    </table>
  </div>
@endsection
