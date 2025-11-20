@extends('layouts.app')

@section('content')
  <h1>{{ isset($trip) ? 'Edit Trip' : 'Add Trip' }}</h1>

  <form action="{{ isset($trip) ? route('admin.trips.update', $trip->id) : route('admin.trips.store') }}" method="POST">
    @csrf
    @if(isset($trip))
      @method('PUT')
    @endif

    <div class="form-group">
      <label>Trip Code</label>
      <input type="text" name="trip_code" class="form-control" value="{{ $trip->trip_code ?? '' }}" required>
    </div>

    <div class="form-group">
      <label>Route</label>
      <select name="route_id" class="form-control" required>
        <option value="">Select Route</option>
        @foreach($routes as $route)
          <option value="{{ $route->id }}" {{ isset($trip) && $trip->route_id == $route->id ? 'selected' : '' }}>
            {{ $route->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Bus</label>
      <select name="bus_id" class="form-control">
        <option value="">Select Bus</option>
        @foreach($buses as $bus)
          <option value="{{ $bus->id }}" {{ isset($trip) && $trip->bus_id == $bus->id ? 'selected' : '' }}>
            {{ $bus->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Trip Date</label>
      <input type="date" name="trip_date" class="form-control" value="{{ $trip->trip_date ?? '' }}" required>
    </div>

    <div class="form-group">
      <label>Departure Time</label>
      <input type="time" name="departure_time" class="form-control" value="{{ $trip->departure_time ?? '' }}" required>
    </div>

    <div class="form-group">
      <label>Arrival Time</label>
      <input type="time" name="arrival_time" class="form-control" value="{{ $trip->arrival_time ?? '' }}">
    </div>

    <div class="form-group">
      <label>Available Seats</label>
      <input type="number" name="available_seats" class="form-control" value="{{ $trip->available_seats ?? 0 }}" required>
    </div>

    <div class="form-group">
      <label>Fare</label>
      <input type="number" step="0.01" name="fare" class="form-control" value="{{ $trip->fare ?? '' }}">
    </div>

    <button type="submit" class="btn btn-primary mt-2">{{ isset($trip) ? 'Update' : 'Save' }}</button>
  </form>
@endsection
