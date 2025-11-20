@extends('layouts.app')

@section('content')
  <h1>Fare Management</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('admin.fares.create') }}" class="btn btn-success mb-3">Add Fare</a>

  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Trip Code</th>
      <th>Route</th>
      <th>Fare</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trips as $trip)
      <tr>
        <td>{{ $trip->trip_code }}</td>
        <td>{{ $trip->route->name ?? '-' }}</td>
        <td>{{ $trip->fare ?? 'N/A' }}</td>
        <td>
          <a href="{{ route('admin.fares.edit', $trip->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.fares.destroy', $trip->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
