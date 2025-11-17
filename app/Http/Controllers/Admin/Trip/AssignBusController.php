<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Bus;
use Illuminate\Http\Request;

class AssignBusController extends Controller
{
  // Show assign bus form
  public function index()
  {
    $trips = Trip::all();
    $buses = Bus::all();

    return view('admin.triproute_management.assign.index', compact('trips', 'buses'));
  }

  // Handle assigning the bus to a Trip_Route Management
  public function assign(Request $request)
  {
    $validated = $request->validate([
      'trip_id' => 'required|exists:trips,id',
      'bus_id'  => 'required|exists:buses,id',
    ]);

    $trip = Trip::findOrFail($validated['trip_id']);

    // Assuming your trips table has a bus_id column
    $trip->update([
      'bus_id' => $validated['bus_id']
    ]);

    return redirect()->route('admin.assign.index')
      ->with('success', 'Bus assigned to Trip_Route Management successfully.');
  }
}
