<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Show booking reports
    public function bookingReports()
    {
        $bookings = Booking::all();
        $totalRevenue = Payment::where('status', 'paid')->sum('amount'); // Sum up paid payments for revenue
        return view('admin.reports.booking_reports', compact('bookings', 'totalRevenue'));
    }

    // Other report generation methods can be added here, e.g., for canceled bookings, popular routes, etc.
}
