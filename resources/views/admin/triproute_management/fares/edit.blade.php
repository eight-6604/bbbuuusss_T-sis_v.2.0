@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Edit Fare</h2>

    <form action="{{ route('admin.fares.update', $fare->id) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label>Route ID</label>
        <input type="number" name="route_id" class="form-control" value="{{ $fare->route_id }}">
      </div>

      <div class="mb-3">
        <label>Fare Price</label>
        <input type="number" name="price" class="form-control" value="{{ $fare->price }}">
      </div>

      <button class="btn btn-primary">Update Fare</button>
    </form>
  </div>
@endsection
