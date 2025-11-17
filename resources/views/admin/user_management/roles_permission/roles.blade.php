@extends('layouts.app')

@section('title', 'User Roles Management')

@section('content')
  <div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-6">Manage User Roles</h1>

    {{-- Include centralized message blade --}}
    @include('message')

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white border border-gray-200">
        <thead>
        <tr class="bg-gray-100">
          <th class="py-2 px-4 border-b">#</th>
          <th class="py-2 px-4 border-b">Name</th>
          <th class="py-2 px-4 border-b">Email</th>
          <th class="py-2 px-4 border-b">Phone</th>
          <th class="py-2 px-4 border-b">Current Role</th>
          <th class="py-2 px-4 border-b">Change Role</th>
        </tr>
        </thead>
        <tbody>
        @forelse($users as $user)
          <tr class="hover:bg-gray-50">
            <td class="py-2 px-4 border-b">{{ $user->id }}</td>
            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $user->email }}</td>
            <td class="py-2 px-4 border-b">{{ $user->phone }}</td>
            <td class="py-2 px-4 border-b capitalize">{{ $user->role }}</td>
            <td class="py-2 px-4 border-b">
              <form action="{{ route('admin.user-roles.update', $user->id) }}" method="POST" class="flex items-center space-x-2">
                @csrf
                @method('PUT')
                <select name="role" class="border rounded px-2 py-1">
                  <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                  <option value="driver" {{ $user->role === 'driver' ? 'selected' : '' }}>Driver</option>
                  <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                  Update
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-4">No users found.</td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
