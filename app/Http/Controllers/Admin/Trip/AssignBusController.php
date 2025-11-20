<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Bus;

class AssignBusController extends Controller
{
  // Show assign bus page
  public function index()
  {
    $trips = Trip::with('bus', 'route')->get();
    $buses = Bus::all();

    return view('admin.triproute_management.assign.index', compact('trips', 'buses'));
  }

  // Assign a bus to a trip
  public function assign(Request $request)
  {
    $request->validate([
      'trip_id' => 'required|exists:trips,id',
      'bus_id'  => 'required|exists:buses,id',
    ]);

    $trip = Trip::findOrFail($request->trip_id);
    $trip->bus_id = $request->bus_id;
    $trip->save();

    return redirect()->route('admin.assign.index')->with('success', 'Bus assigned successfully.');
  }
}
