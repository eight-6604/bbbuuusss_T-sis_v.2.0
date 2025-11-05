@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Bus - {{ $bus->bus_name }}</h2>

    <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Bus Number</label>
            <input type="text" name="bus_number" class="form-control" value="{{ $bus->bus_number }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bus Name</label>
            <input type="text" name="bus_name" class="form-control" value="{{ $bus->bus_name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bus Type</label>
            <input type="text" name="bus_type" class="form-control" value="{{ $bus->bus_type }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="total_seats" class="form-control" value="{{ $bus->total_seats }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bus Image</label>
            @if($bus->bus_img)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $bus->bus_img) }}" width="120" alt="Bus Image">
                </div>
            @endif
            <input type="file" name="bus_imge" class="form-control">
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">Back / Cancel</a>
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
</div>
@endsection
