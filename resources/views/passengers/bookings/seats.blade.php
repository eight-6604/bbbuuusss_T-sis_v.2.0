@extends('layouts.user')

@section('content')

  <div class="max-w-3xl mx-auto py-10">

    <h2 class="text-xl font-bold mb-4">Select Your Seat</h2>

    <div class="bg-white shadow rounded p-6">

      <div class="grid grid-cols-4 gap-4 mb-6">
        @foreach($seats as $seat)
          <label class="cursor-pointer">
            <input type="radio" name="seat_id" value="{{ $seat->id }}" class="hidden seat-radio"
                   @if($seat->isBooked($trip->id)) disabled @endif>

            <div class="
                        p-3 text-center rounded-lg border
                        @if($seat->isBooked($trip->id)) bg-red-300 border-red-500 text-white cursor-not-allowed
                        @else bg-green-100 hover:bg-green-200
                        @endif
                    ">
              {{ $seat->seat_number }}
            </div>
          </label>
        @endforeach
      </div>

      <form id="seatForm" method="POST" action="{{ route('user.bookings.confirm', $trip->id) }}">
        @csrf
        <input type="hidden" name="seat_id" id="selectedSeatInput">

        <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-bold">
          Continue
        </button>
      </form>

    </div>

  </div>

  <script>
    document.querySelectorAll('.seat-radio').forEach(seat => {
      seat.addEventListener('change', function () {
        document.getElementById('selectedSeatInput').value = this.value;
      });
    });
  </script>

@endsection
