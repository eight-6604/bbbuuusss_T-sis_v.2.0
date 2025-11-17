@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Trips</h2>

    <a href="{{ route('admin.trips.create') }}" class="btn btn-primary mb-3">Add Trip</a>

    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Route</th>
        <th>Bus</th>
        <th>Departure</th>
        <th>Arrival</th>
        <th>Fare</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach($trips as $trip)
        <tr>
          <td>{{ $trip->route_id }}</td>
          <td>{{ $trip->bus_id }}</td>
          <td>{{ $trip->departure_time }}</td>
          <td>{{ $trip->arrival_time }}</td>
          <td>{{ $trip->fare }}</td>
          <td>
            <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.trips.destroy', $trip->id) }}" class="d-inline" method="POST">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Delete trip?')">Delete</button>
            </form>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endsection
