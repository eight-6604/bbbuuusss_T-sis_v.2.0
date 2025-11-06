@extends('layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Bus Types</h1>
    <a href="{{ route('admin.bus-types.create') }}" 
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
       + Add Bus Type
    </a>
</div>

<table class="table-auto w-full border border-gray-300">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Name</th>
            <th class="px-4 py-2 border">Description</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($busTypes as $type)
        <tr>
            <td class="border px-4 py-2">{{ $type->id }}</td>
            <td class="border px-4 py-2">{{ $type->type_name }}</td>
            <td class="border px-4 py-2">{{ $type->description }}</td>
            <td class="border px-4 py-2 space-x-2">
                <a href="{{ route('admin.bus-types.edit', $type) }}" 
                   class="text-blue-500 hover:underline">Edit</a>
                <form action="{{ route('admin.bus-types.destroy', $type) }}" 
                      method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:underline" 
                            onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="border px-4 py-2 text-center">No bus types found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
