@extends('layout.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Add New Bus Type</h1>

    {{-- Back button --}}
    <a href="{{ route('admin.bus-types.index') }}" 
       class="inline-block mb-4 text-blue-500 hover:underline">&larr; Back to List</a>

    {{-- Form --}}
    <form action="{{ route('admin.bus-types.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="type_name" class="block text-sm font-medium text-gray-700 mb-1">Bus Type Name</label>
            <input type="text" name="type_name" id="type_name" 
                   class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                   placeholder="Enter bus type name" value="{{ old('type_name') }}" required>
            @error('type_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      placeholder="Optional description">{{ old('description') }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.bus-types.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">Cancel</a>

            <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Save Bus Type
            </button>
        </div>
    </form>
</div>
@endsection
