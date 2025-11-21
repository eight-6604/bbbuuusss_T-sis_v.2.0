@extends('layouts.user')

@section('content')

  <div class="max-w-4xl mx-auto py-10">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">Available Trips</h2>

    @forelse($trips as $trip)
      <div class="bg-white shadow rounded-lg p-5 mb-4 flex justify-between items-center">

        <div>
          <h4 class="text-lg font-semibold">{{ $trip->bus->name }}</h4>
          <p class="text-gray-600">{{ $trip->departure_time }} → {{ $trip->arrival_time }}</p>
          <p class="text-sm text-gray-500">
            Seats Available: <strong>{{ $trip->availableSeats() }}</strong>
          </p>
        </div>

        <a href="{{ route('user.bookings.selectSeats', $trip->id) }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
          Select Seats
        </a>

      </div>
    @empty
      <div class="text-center text-gray-500 py-10">No trips available for this route & date.</div>
    @endforelse

  </div>

@endsection
