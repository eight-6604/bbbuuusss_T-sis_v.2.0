@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Add Fare</h2>

    <form action="{{ route('admin.fares.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label>Route ID</label>
        <input type="number" name="route_id" class="form-control">
      </div>

      <div class="mb-3">
        <label>Fare Price</label>
        <input type="number" name="price" class="form-control">
      </div>

      <button class="btn btn-primary">Create Fare</button>
    </form>
  </div>
@endsection
