@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Bus Details</h2>

    <div class="card mt-3 p-3">
        <div class="row">
            <div class="col-md-4">
                @if($bus->bus_image)
                    <img src="{{ asset('storage/' . $bus->bus_image) }}" class="img-fluid rounded" alt="Bus Image">
                @else
                    <img src="{{ asset('images/no-image.png') }}" class="img-fluid rounded" alt="No Image">
                @endif
            </div>
            <div class="col-md-8">
                <h4>{{ $bus->bus_name }}</h4>
                <p><strong>Bus Number:</strong> {{ $bus->bus_number }}</p>
                <p><strong>Type:</strong> {{ $bus->bus_type }}</p>
                <p><strong>Capacity:</strong> {{ $bus->capacity }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge {{ $bus->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($bus->status) }}
                    </span>
                </p>

                <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary mt-3">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
