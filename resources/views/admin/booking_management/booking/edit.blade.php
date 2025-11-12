<!-- resources/views/admin/booking_management/booking/edit.blade.php -->

@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
    <div class="container">
        <h1 class="my-4">Edit Booking</h1>

        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- Add form fields as before, pre-fill the values from the $booking model -->
        </form>
    </div>
@endsection
