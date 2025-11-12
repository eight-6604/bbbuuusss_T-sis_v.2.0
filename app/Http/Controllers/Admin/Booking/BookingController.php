<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Show all bookings
    public function index()
    {
        // Paginate bookings with 10 per page (adjust as needed)
        $bookings = Booking::paginate(10);

        return view('admin.booking_management.booking.index', compact('bookings'));
    }

    // Show the form to create a new booking
    public function create()
    {
        return view('admin.booking_management.booking.create');
    }

    // Store a newly created booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bus_id' => 'required|exists:buses,id',
            'seat_number' => 'required|integer',
            'departure_time' => 'required|date',
            // Add more validation as per your requirements
        ]);

        Booking::create($validated);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully!');
    }

    // Show the specific booking
    public function show(Booking $booking)
    {
        return view('admin.booking_management.booking.show', compact('booking'));
    }

    // Show the form to edit a booking
    public function edit(Booking $booking)
    {
        return view('admin.booking_management.booking.edit', compact('booking'));
    }

    // Update the booking details
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bus_id' => 'required|exists:buses,id',
            'seat_number' => 'required|integer',
            'departure_time' => 'required|date',
            // Add more validation as needed
        ]);

        $booking->update($validated);
        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully!');
    }

    // Delete a booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully!');
    }

    // Show pending bookings
    public function pending()
    {
        $pendingBookings = Booking::where('status', 'pending')->paginate(10);
        return view('admin.booking_management.status.pending', compact('pendingBookings'));
    }

    // Show cancelled bookings
    public function cancelled()
    {
        $cancelledBookings = Booking::where('status', 'cancelled')->paginate(10);
        return view('admin.booking_management.status.cancelled', compact('cancelledBookings'));
    }

    // Show completed bookings
    public function completed()
    {
        $completedBookings = Booking::where('status', 'pending')->paginate(10);  // This should be completed, not pending
        return view('admin.booking_management.status.completed', compact('completedBookings'));
    }


    // Manage booking notifications (re-send, etc.)
    public function notifications()
    {
        // You can implement sending notifications logic here (e.g., sending email or SMS)
        return view('admin.booking_management.booking.notifications');
    }
}
