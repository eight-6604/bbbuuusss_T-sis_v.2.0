<!-- resources/views/admin/booking_management/booking/show.blade.php -->

@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
    <div class="container">
        <h1 class="my-4">Booking Details - {{ $booking->booking_reference }}</h1>

        <ul class="list-group">
            <li class="list-group-item"><strong>User:</strong> {{ $booking->user->name }}</li>
            <li class="list-group-item"><strong>Bus:</strong> {{ $booking->bus->name }}</li>
            <li class="list-group-item"><strong>Route:</strong> {{ $booking->route->name }}</li>
            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($booking->status) }}</li>
            <li class="list-group-item"><strong>Amount Paid:</strong> ${{ number_format($booking->amount_paid, 2) }}</li>
        </ul>

        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning mt-3">Edit Booking</a>
    </div>
@endsection
