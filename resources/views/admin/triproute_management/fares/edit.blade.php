@extends('layouts.app')

@section('content')
  <h1>Edit Fare</h1>

  <form action="{{ route('admin.fares.update', $trip->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label>Trip</label>
      <input type="text" class="form-control" value="{{ $trip->trip_code }}" disabled>
    </div>

    <div class="form-group">
      <label>Fare</label>
      <input type="number" step="0.01" name="fare" class="form-control" value="{{ $trip->fare }}" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2">Update</button>
  </form>
@endsection
