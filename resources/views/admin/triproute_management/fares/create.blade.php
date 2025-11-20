@extends('layouts.app')

@section('content')
  <h1>Add Fare</h1>

  <form action="{{ route('fares.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label>Trip</label>
      <select name="trip_id" class="form-control" required>
        <option value="">Select Trip</option>
        @foreach($trips as $trip)
          <option value="{{ $trip->id }}">{{ $trip->trip_code }} - {{ $trip->route->name ?? '-' }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label>Fare</label>
      <input type="number" step="0.01" name="fare" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Save</button>
  </form>
@endsection
