<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Route;
use App\Models\Trip;
use App\Models\Seat;
use App\Models\Booking;

class BookingController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | STEP 1 — Show Route + Date Selection Form
  |--------------------------------------------------------------------------
  */
  public function create()
  {
    // Get all unique routes for dropdown
    $routes = Route::select('from', 'to')->distinct()->get();

    return view('passengers.bookings.create', compact('routes'));
  }


  /*
  |--------------------------------------------------------------------------
  | STEP 1 (POST) — Save selected route + date & redirect to trips page
  |--------------------------------------------------------------------------
  */
  public function storeRouteDate(Request $request)
  {
    $request->validate([
      'from'        => 'required|string',
      'to'          => 'required|string|different:from',
      'travel_date' => 'required|date|after_or_equal:today',
    ]);

    return redirect()->route(
      'user.bookings.selectTrip',
      [
        'from' => $request->from,
        'to'   => $request->to,
        'date' => $request->travel_date,
      ]
    );
  }


  /*
  |--------------------------------------------------------------------------
  | STEP 2 — Show available trips for selected route
  |--------------------------------------------------------------------------
  */
  public function selectTrip($from, $to, $date)
  {
    $travelDate = Carbon::parse($date);

    $trips = Trip::whereHas('route', function ($q) use ($from, $to) {
      $q->where('from', $from)->where('to', $to);
    })
      ->whereDate('departure_time', $travelDate)
      ->with(['bus', 'route'])
      ->get();

    return view('passengers.bookings.select-trip', compact('trips'));
  }


  /*
  |--------------------------------------------------------------------------
  | STEP 3 — Seat Selection for chosen trip
  |--------------------------------------------------------------------------
  */
  public function selectSeats(Trip $trip)
  {
    $seats = Seat::where('bus_id', $trip->bus_id)->orderBy('seat_number')->get();

    return view('passengers.bookings.seats', compact('trip', 'seats'));
  }


  /*
  |--------------------------------------------------------------------------
  | STEP 4 — Confirm Booking page
  |--------------------------------------------------------------------------
  */
  public function confirm(Request $request, Trip $trip)
  {
    $request->validate([
      'seat_id' => 'required|exists:seats,id',
    ]);

    $seat = Seat::find($request->seat_id);

    // Prevent double booking
    $alreadyBooked = Booking::where('trip_id', $trip->id)
      ->where('seat_id', $seat->id)
      ->exists();

    if ($alreadyBooked) {
      return back()->with('error', 'This seat has just been booked. Please choose another.');
    }

    $bookingData = [
      'travel_date' => $trip->departure_time->format('Y-m-d'),
      'fare'        => $trip->fare ?? 0,
    ];

    return view('passengers.bookings.confirm', compact('trip', 'seat', 'bookingData'));
  }


  /*
  |--------------------------------------------------------------------------
  | FINAL — Store booking in database
  |--------------------------------------------------------------------------
  */
  public function storeFinal(Request $request, Trip $trip)
  {
    $request->validate([
      'seat_id'     => 'required|exists:seats,id',
      'travel_date' => 'required|date',
    ]);

    $seat = Seat::findOrFail($request->seat_id);

    // Prevent double booking again
    if (
      Booking::where('trip_id', $trip->id)
        ->where('seat_id', $seat->id)
        ->exists()
    ) {
      return redirect()->route('user.bookings.create')
        ->with('error', 'Seat already booked. Please start again.');
    }

    $booking = Booking::create([
      'user_id'     => Auth::id(),
      'bus_id'      => $trip->bus_id,
      'route_id'    => $trip->route_id,
      'trip_id'     => $trip->id,
      'seat_id'     => $seat->id,

      'seat_number' => $seat->seat_number,
      'seat_type'   => $seat->type ?? 'economy',

      'departure_time' => $trip->departure_time,
      'arrival_time'   => $trip->arrival_time,

      'amount_paid'    => $trip->fare,
      'payment_status' => 'unpaid',

      'status'          => 'pending',
      'booking_reference' => $this->generateReference(),
    ]);

    return redirect()
      ->route('user.bookings.index')
      ->with('success', 'Booking successfully created!');
  }


  /*
  |--------------------------------------------------------------------------
  | Generate Booking Reference Code
  |--------------------------------------------------------------------------
  */
  private function generateReference()
  {
    return 'BKG-' . strtoupper(Str::random(8));
  }


  /*
  |--------------------------------------------------------------------------
  | Booking List
  |--------------------------------------------------------------------------
  */
  public function index()
  {
    $bookings = Booking::where('user_id', Auth::id())
      ->latest()
      ->paginate(10);

    return view('passengers.bookings.index', compact('bookings'));
  }
}
