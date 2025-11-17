@extends('layouts.admin')

@section('content')
  <div class="container">
    <h2>Assign Bus to Trip</h2>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.assign.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label>Trip</label>
        <select name="trip_id" class="form-control">
          @foreach($trips as $t)
            <option value="{{ $t->id }}">Trip {{ $t->id }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label>Bus</label>
        <select name="bus_id" class="form-control">
          @foreach($buses as $b)
            <option value="{{ $b->id }}">{{ $b->name ?? 'Bus ' . $b->id }}</option>
          @endforeach
        </select>
      </div>

      <button class="btn btn-primary">Assign</button>
    </form>
  </div>
@endsection
