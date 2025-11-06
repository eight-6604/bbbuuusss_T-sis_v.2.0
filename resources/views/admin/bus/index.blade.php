@extends('layout.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 class="mb-2">🚌 All Buses</h2>
        <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Bus
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0 table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Bus Name / Model</th>
                        <th>Bus Number</th>
                        <th>Type</th>
                        <th>Seat Layout</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($buses as $bus)
                        <tr class="text-center">
                            <td>{{ $bus->id }}</td>

                            <!-- Bus Image -->
                            <td>
                                @if($bus->bus_img)
                                    <img src="{{ asset('storage/' . $bus->bus_img) }}" 
                                         alt="Bus Image" 
                                         width="70" height="50" 
                                         class="rounded border shadow-sm">
                                @else
                                    <span class="text-muted fst-italic">No Image</span>
                                @endif
                            </td>

                            <td>{{ $bus->bus_name }}</td>
                            <td>{{ $bus->bus_number }}</td>
                            <td>{{ $bus->type->type_name ?? 'N/A' }}</td>

                            <!-- Seat Layout -->
                            <td>
                                @if($bus->seatLayout)
                                    {{ $bus->seatLayout->layout_name }} 
                                    <span class="text-muted small d-block">
                                        {{ $bus->seatLayout->rows }}×{{ $bus->seatLayout->columns }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>

                            <!-- Capacity -->
                            <td><strong>{{ $bus->total_seats }}</strong></td>

                            <!-- Status -->
                            <td>
                                <span class="badge {{ $bus->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($bus->status) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <!-- 👁️ View -->
                                    <a href="{{ route('admin.buses.show', $bus->id) }}" 
                                       class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <!-- ✏️ Edit -->
                                    <a href="{{ route('admin.buses.edit', $bus->id) }}" 
                                       class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- 🗑️ Delete -->
                                    <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this bus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr> 
                            <td colspan="9" class="text-center text-muted py-3">No buses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (if using paginate() in controller) -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $buses->links() }}
    </div>
</div>
@endsection
