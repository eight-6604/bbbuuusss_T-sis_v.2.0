@extends('layouts.app')

@section('content')
  <h1>Trips / Schedules</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('admin.trips.create') }}" class="btn btn-success mb-3">Add Trip</a>

  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Trip Code</th>
      <th>Route</th>
      <th>Bus</th>
      <th>Date</th>
      <th>Departure</th>
      <th>Arrival</th>
      <th>Seats</th>
      <th>Fare</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trips as $trip)
      <tr>
        <td>{{ $trip->trip_code ?? '-' }}</td>
        <td>{{ $trip->route->route_name ?? '-' }}</td>
        <td>{{ $trip->bus->bus_name ?? 'Unassigned' }}</td>
        <td>{{ $trip->trip_date->format('Y-m-d') }}</td>
        <td>{{ $trip->departure_time }}</td>
        <td>{{ $trip->arrival_time ?? '-' }}</td>
        <td>{{ $trip->available_seats }}</td>
        <td>{{ $trip->fare ?? '-' }}</td>
        <td>
          @if($trip->is_active)
            <span class="badge bg-success">Active</span>
          @else
            <span class="badge bg-danger">Cancelled</span>
          @endif
        </td>
        <td>
          <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning btn-sm">Edit</a>
          <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
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
