@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Edit Route</h2>

    <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
      @csrf @method('PUT')

      <div class="mb-3">
        <label class="form-label">Route Name</label>
        <input type="text" name="name" class="form-control" value="{{ $route->name }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Start Location</label>
        <input type="text" name="start_location" class="form-control" value="{{ $route->start_location }}">
      </div>

      <div class="mb-3">
        <label class="form-label">End Location</label>
        <input type="text" name="end_location" class="form-control" value="{{ $route->end_location }}">
      </div>

      <button class="btn btn-primary">Update</button>
    </form>
  </div>
@endsection
