<!-- resources/views/admin/booking_management/booking/create.blade.php -->

@extends('layouts.app')

@section('title', 'Create New Booking')

@section('content')
    <div class="container">
        <h1 class="my-4">Create New Booking</h1>

        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf
            <!-- Add form fields as before... -->
            <!-- Make sure to replace the previous input names with valid ones as needed -->
        </form>
    </div>
@endsection
