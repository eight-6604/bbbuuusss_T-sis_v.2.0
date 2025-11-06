@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 font-bold text-xl">Add Seat Layout</h2>

    <form action="{{ route('admin.seat-layouts.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Layout Name</label>
            <input type="text" name="layout_name" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Bus Type</label>
            <select name="bus_type_id" class="form-select" required>
                <option value="">-- Select Type --</option>
                @foreach($busTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Rows</label>
            <input type="number" name="rows" class="form-control" min="1" value="4" required>
        </div>

        <div class="form-group mb-3">
            <label>Columns</label>
            <input type="number" name="columns" class="form-control" min="1" value="4" required>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('admin.seat-layouts.index') }}" class="btn btn-secondary">← Back</a>
            <button type="submit" class="btn btn-success">Save Layout</button>
        </div>
    </form>
</div>
@endsection
