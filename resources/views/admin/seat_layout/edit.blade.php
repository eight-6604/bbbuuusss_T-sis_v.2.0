@extends('layout.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Seat Layout</h1>

    <form action="{{ route('admin.seat-layouts.update', $layout->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-1">Layout Name</label>
            <input type="text" name="layout_name" value="{{ old('layout_name', $layout->layout_name) }}" 
                class="border rounded w-full px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Bus Type</label>
            <select name="bus_type_id" class="border rounded w-full px-3 py-2" required>
                <option value="">-- Select Bus Type --</option>
                @foreach ($busTypes as $busType)
                    <option value="{{ $busType->id }}" 
                        {{ $busType->id == $layout->bus_type_id ? 'selected' : '' }}>
                        {{ $busType->type_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Rows</label>
                <input type="number" name="rows" value="{{ old('rows', $layout->rows) }}" 
                    class="border rounded w-full px-3 py-2" required min="1" max="20">
            </div>
            <div>
                <label class="block font-semibold mb-1">Columns</label>
                <input type="number" name="columns" value="{{ old('columns', $layout->columns) }}" 
                    class="border rounded w-full px-3 py-2" required min="1" max="10">
            </div>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.seat-layouts.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
               Cancel
            </a>
            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
