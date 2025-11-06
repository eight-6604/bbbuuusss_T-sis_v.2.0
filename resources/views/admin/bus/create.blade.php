@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Add New Bus</h2>

        <!-- Success / Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.buses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Bus Number / Registration -->
            <div class="form-group mb-3">
                <label for="bus_number">Bus Number / Registration</label>
                <input type="text" id="bus_number" name="bus_number" class="form-control" value="{{ old('bus_number') }}"
                    required>
            </div>

            <!-- Bus Name / Model -->
            <div class="form-group mb-3">
                <label for="bus_name">Bus Name / Model</label>
                <input type="text" id="bus_name" name="bus_name" class="form-control" value="{{ old('bus_name') }}"
                    required>
            </div>
            <!-- Bus Type -->
            <div class="form-group mb-3">
                <label for="bus_type_id">Bus Type</label>
                <select id="bus_type_id" name="bus_type_id" class="form-select" required>
                    <option value="">-- Select Type --</option>
                    @foreach ($busTypes as $type)
                        <option value="{{ $type->id }}" {{ old('bus_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->type_name }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Capacity -->
            <div class="form-group mb-3">
                <label for="total_seats">Bus Capacity (Number of Seats)</label>
                <input type="number" id="total_seats" name="total_seats" class="form-control"
                    value="{{ old('total_seats') }}" min="1" required>
            </div>

            <!-- Bus Image -->
            <div class="form-group mb-4">
                <label for="bus_img">Bus Image</label>
                <input type="file" id="bus_img" name="bus_img" class="form-control" accept="image/*">
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">← Back</a>
                <div>
                    <button type="reset" class="btn btn-warning text-white">Reset</button>
                    <button type="submit" class="btn btn-success">Save Bus</button>
                </div>
            </div>
        </form>
    </div>
@endsection
