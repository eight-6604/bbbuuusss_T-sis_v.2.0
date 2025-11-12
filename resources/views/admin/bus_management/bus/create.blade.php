@extends('layouts.app')

@section('content')
<div class="page-container">
    <h4 class="page-title">Add New Bus</h4>

    <form action="{{ route('admin.buses.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @csrf

        {{-- Bus Number --}}
        <div class="form-group">
            <label for="busNumber" class="form-label">Bus Number</label>
            <input type="text" name="bus_number" id="busNumber" class="form-input" value="{{ old('bus_number') }}" required>
            @error('bus_number')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Bus Name --}}
        <div class="form-group">
            <label for="busName" class="form-label">Bus Name</label>
            <input type="text" name="bus_name" id="busName" class="form-input" value="{{ old('bus_name') }}" required>
            @error('bus_name')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Bus Type --}}
        <div class="form-group">
            <label for="busType" class="form-label">Bus Type</label>
            <select name="bus_type_id" id="busType" class="form-select" required>
                <option value="">-- Select Bus Type --</option>
                @foreach($busTypes as $type)
                    @if($type->seatLayout)
                        <option 
                            value="{{ $type->id }}"
                            data-layout="{{ $type->seatLayout->layout_name }}"
                            data-layout-id="{{ $type->seatLayout->id }}"
                            data-total="{{ $type->seatLayout->capacity }}"
                            {{ old('bus_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->type_name }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('bus_type_id')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Seat Layout --}}
        <div class="form-group">
            <label for="seatLayout" class="form-label">Seat Layout</label>
            <input type="text" id="seatLayout" class="form-input" value="{{ old('seat_layout_name') }}" disabled>
            <input type="hidden" name="seat_layout_id" id="seatLayoutId" value="{{ old('seat_layout_id') }}">
        </div>

        {{-- Total Seats --}}
        <div class="form-group">
            <label for="totalSeats" class="form-label">Total Seats</label>
            <input type="number" id="totalSeats" class="form-input" value="{{ old('total_seats') }}" disabled>
            <input type="hidden" name="total_seats" id="totalSeatsHidden" value="{{ old('total_seats') }}">
        </div>

        {{-- Bus Image --}}
        <div class="form-group">
            <label for="busImage" class="form-label">Bus Image</label>
            <input type="file" name="bus_img" id="busImage" class="form-input">
            @error('bus_img')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Status --}}
        <div class="form-group">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-textarea" rows="3">{{ old('description') }}</textarea>
            @error('description')<div class="form-error">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Bus</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const busTypeSelect = document.getElementById('busType');
    const seatLayoutInput = document.getElementById('seatLayout');
    const seatLayoutIdHidden = document.getElementById('seatLayoutId');
    const totalSeatsInput = document.getElementById('totalSeats');
    const totalSeatsHidden = document.getElementById('totalSeatsHidden');

    busTypeSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];

        const layout = selected.dataset.layout || '';
        const layoutId = selected.dataset.layoutId || '';
        const totalSeats = selected.dataset.total || '';

        seatLayoutInput.value = layout;
        seatLayoutIdHidden.value = layoutId;
        totalSeatsInput.value = totalSeats;
        totalSeatsHidden.value = totalSeats;
    });

    if(busTypeSelect.value) {
        busTypeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
