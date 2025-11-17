@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Create Trip</h2>

    <form action="{{ route('admin.trips.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label>Route ID</label>
        <input type="number" name="route_id" class="form-control">
      </div>

      <div class="mb-3">
        <label>Bus ID</label>
        <input type="number" name="bus_id" class="form-control">
      </div>

      <div class="mb-3">
        <label>Departure Time</label>
        <input type="datetime-local" name="departure_time" class="form-control">
      </div>

      <div class="mb-3">
        <label>Arrival Time</label>
        <input type="datetime-local" name="arrival_time" class="form-control">
      </div>

      <div class="mb-3">
        <label>Fare</label>
        <input type="number" name="fare" class="form-control">
      </div>

      <button class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection
