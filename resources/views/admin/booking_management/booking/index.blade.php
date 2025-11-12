<!-- resources/views/admin/booking_management/booking/index.blade.php -->

@extends('layouts.app')

@section('title', 'All Bookings')

@section('content')
    <div class="container">
        <h1 class="my-4">All Bookings</h1>

        <a href="{{ route('admin.bookings.create') }}" class="btn btn-primary mb-3">Create New Booking</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking Reference</th>
                    <th>User</th>
                    <th>Bus</th>
                    <th>Route</th>
                    <th>Status</th>
                    <th>Amount Paid</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->bus->name }}</td>
                        <td>{{ $booking->route->name }}</td>
                        <td>
                            <span class="badge badge-{{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'confirmed' ? 'success' : 'danger') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td>${{ number_format($booking->amount_paid, 2) }}</td>
                        <td>
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $bookings->links() }} <!-- Pagination links -->
    </div>
@endsection
