@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">All Buses</h2>
        <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">+ Add New Bus</a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th>id</th>
                        <th>Image</th>
                        <th>Bus Name / Model</th>
                        <th>Bus Number</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buses as $bus)
                        <tr class="text-center align-middle">
                            <td>{{ $bus->id }}</td>

                            <!-- Bus Image -->
                            <td>
                                @if($bus->bus_img)
                                    <img src="{{ asset('storage/' . $bus->bus_img) }}" 
                                         alt="Bus Image" 
                                         width="70" height="50" 
                                         class="rounded border">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $bus->bus_name }}</td>
                            <td>{{ $bus->bus_number }}</td>
                            <td>{{ $bus->bus_type ?? 'N/A' }}</td>
                            <td>{{ $bus->total_seats }}</td>
                            <td>
                                <span class="badge {{ $bus->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($bus->status) }}
                                </span>
                            </td>

                            <!-- Action Buttons -->
                            <td>
    <div class="d-flex justify-content-center gap-2">
        {{-- 👁️ View Bus Details --}}
        <a href="{{ route('admin.buses.show', $bus->id) }}" class="btn btn-sm btn-info text-white">
            <i class="bi bi-eye"></i> View
        </a>

        {{-- ✏️ Edit Bus --}}
        <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-sm btn-warning text-white">
            <i class="bi bi-pencil-square"></i> Edit
        </a>

        {{-- 🗑️ Delete Bus --}}
        <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this bus?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i> Delete
            </button>
        </form>
    </div>
</td>

                        </tr>
                    @empty
                        <tr> 
                            <td colspan="8" class="text-center text-muted py-3">No buses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
