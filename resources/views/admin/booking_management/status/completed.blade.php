<!-- resources/views/admin/booking_management/status/completed.blade.php -->

@extends('layouts.app')

@section('title', 'Completed Bookings')

@section('content')
    <div class="container">
        <h1 class="my-4">Completed Bookings</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking Reference</th>
                    <th>User</th>
                    <th>Bus</th>
                    <th>Route</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($completedBookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->bus->name }}</td>
                        <td>{{ $booking->route->name }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                        <td>
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $completedBookings->links() }} <!-- Pagination links -->
    </div>
@endsection
