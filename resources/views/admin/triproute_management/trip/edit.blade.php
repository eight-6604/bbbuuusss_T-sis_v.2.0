@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Edit Trip</h2>

    <form action="{{ route('admin.trips.update', $trip->id) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label>Route ID</label>
        <input type="number" name="route_id" class="form-control" value="{{ $trip->route_id }}">
      </div>

      <div class="mb-3">
        <label>Bus ID</label>
        <input type="number" name="bus_id" class="form-control" value="{{ $trip->bus_id }}">
      </div>

      <div class="mb-3">
        <label>Departure Time</label>
        <input type="datetime-local" name="departure_time" class="form-control" value="{{ $trip->departure_time }}">
      </div>

      <div class="mb-3">
        <label>Arrival Time</label>
        <input type="datetime-local" name="arrival_time" class="form-control" value="{{ $trip->arrival_time }}">
      </div>

      <div class="mb-3">
        <label>Fare</label>
        <input type="number" name="fare" class="form-control" value="{{ $trip->fare }}">
      </div>

      <button class="btn btn-primary">Update</button>
    </form>
  </div>
@endsection
