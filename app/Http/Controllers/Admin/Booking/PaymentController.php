<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show all payments
    public function index()
    {
        $payments = Payment::all();  // You can add filters, such as by status or date
        return view('admin.payments.index', compact('payments'));
    }

    // Show a specific payment
    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    // Update payment status (e.g., mark as paid or refunded)
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'status' => 'required|in:paid,pending,failed,refunded',  // Define payment status
        ]);

        $payment->update($validated);
        return redirect()->route('admin.payments.index')->with('success', 'Payment status updated!');
    }

    // Handle payment deletion or refund (depending on your business logic)
    public function destroy(Payment $payment)
    {
        $payment->update(['status' => 'refunded']);  // Change this logic depending on your needs
        return redirect()->route('admin.payments.index')->with('success', 'Payment refunded!');
    }
}
