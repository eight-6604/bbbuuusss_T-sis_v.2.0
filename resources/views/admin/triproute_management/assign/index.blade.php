@extends('layouts.app')

@section('content')
  <h1>Assign Bus to Trip</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
    <tr>
      <th>Trip Code</th>
      <th>Route</th>
      <th>Bus</th>
      <th>Trip Date</th>
      <th>Status</th>
      <th>Assign Bus</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trips as $trip)
      <tr>
        <td>{{ $trip->trip_code ?? '-' }}</td>
        <td>{{ $trip->route->route_name ?? '-' }}</td>
        <td>{{ $trip->bus->bus_name ?? 'Unassigned' }}</td>
        <td>{{ $trip->trip_date->format('Y-m-d') }}</td>
        <td>
          @if($trip->is_active)
            <span class="badge bg-success">Active</span>
          @else
            <span class="badge bg-danger">Cancelled</span>
          @endif
        </td>
        <td>
          <form action="{{ route('admin.assign.store') }}" method="POST" class="d-flex align-items-center">
            @csrf
            <input type="hidden" name="trip_id" value="{{ $trip->id }}">
            <select name="bus_id" class="form-select form-select-sm me-2" required>
              <option value="">Select Bus</option>
              @foreach($buses as $bus)
                <option value="{{ $bus->id }}" {{ $trip->bus_id == $bus->id ? 'selected' : '' }}>
                  {{ $bus->bus_name }}
                </option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-primary btn-sm">Assign</button>
          </form>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection
