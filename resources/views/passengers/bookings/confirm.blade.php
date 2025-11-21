@extends('layouts.user')

@section('content')

  <div class="max-w-2xl mx-auto py-10">
    <h2 class="text-xl font-bold mb-6">Confirm Booking</h2>

    <div class="bg-white shadow p-6 rounded">

      <p><strong>Route:</strong> {{ $trip->route->from }} → {{ $trip->route->to }}</p>
      <p><strong>Date:</strong> {{ $bookingData['travel_date'] }}</p>
      <p><strong>Bus:</strong> {{ $trip->bus->name }}</p>
      <p><strong>Seat:</strong> {{ $seat->seat_number }}</p>
      <p><strong>Fare:</strong> ${{ number_format($trip->fare, 2) }}</p>

      <form method="POST" action="{{ route('user.bookings.storeFinal', $trip->id) }}" class="mt-6">
        @csrf

        <input type="hidden" name="seat_id" value="{{ $seat->id }}">
        <input type="hidden" name="travel_date" value="{{ $bookingData['travel_date'] }}">

        <button class="w-full py-3 bg-green-600 hover:bg-green-700 text-white rounded font-semibold">
          Confirm Booking
        </button>
      </form>

    </div>
  </div>

@endsection
