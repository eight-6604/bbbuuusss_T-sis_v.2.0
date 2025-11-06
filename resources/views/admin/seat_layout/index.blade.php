@extends('layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Seat Layouts</h1>
    <a href="{{ route('admin.seat-layouts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        + Add Layout
    </a>
</div>

<table class="table-auto w-full border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Layout Name</th>
            <th class="px-4 py-2 border">Bus Type</th>
            <th class="px-4 py-2 border">Rows</th>
            <th class="px-4 py-2 border">Columns</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($layouts as $layout)
        <tr>
            <td class="border px-4 py-2">{{ $layout->id }}</td>
            <td class="border px-4 py-2">{{ $layout->layout_name }}</td>
            <td class="border px-4 py-2">{{ $layout->busType->type_name ?? 'N/A' }}</td>
            <td class="border px-4 py-2">{{ $layout->rows }}</td>
            <td class="border px-4 py-2">{{ $layout->columns }}</td>
            <td class="border px-4 py-2 space-x-2">
                <a href="{{ route('admin.seat-layouts.edit', $layout) }}" class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('admin.seat-layouts.destroy', $layout) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="border px-4 py-2 text-center">No seat layouts found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
