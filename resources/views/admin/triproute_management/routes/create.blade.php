@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Create Route</h2>

    <form action="{{ route('admin.routes.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Route Name</label>
        <input type="text" name="name" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Start Location</label>
        <input type="text" name="start_location" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">End Location</label>
        <input type="text" name="end_location" class="form-control">
      </div>

      <button class="btn btn-primary">Create</button>
    </form>
  </div>
@endsection
