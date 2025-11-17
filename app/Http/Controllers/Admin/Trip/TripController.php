<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Trip;  // Assuming you have a Trip model
use Illuminate\Http\Request;

class TripController extends Controller
{
  // Display a listing of the trips
  public function index()
  {
    $trips = Trip::all();  // Fetch all trips from the database
    return view('admin.triproute_management.trips.index', compact('trips'));
  }

  // Show the form for creating a new Trip_Route Management
  public function create()
  {
    return view('admin.triproute_management.trips.create');
  }

  // Store a newly created Trip_Route Management in the database
  public function store(Request $request)
  {
    $validated = $request->validate([
      'route_id' => 'required|exists:routes,id',  // Ensure route exists
      'bus_id' => 'required|exists:buses,id',     // Ensure bus exists
      'departure_time' => 'required|date',
      'arrival_time' => 'required|date',
      'fare' => 'required|numeric|min:0',
    ]);

    Trip::create($validated);

    return redirect()->route('admin.trips.index')->with('success', 'Trip created successfully.');
  }

  // Show the form for editing the specified Trip_Route Management
  public function edit($id)
  {
    $trip = Trip::findOrFail($id);
    return view('admin.triproute_management.trips.edit', compact('trip'));
  }

  // Update the specified Trip_Route Management in the database
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'route_id' => 'required|exists:routes,id',
      'bus_id' => 'required|exists:buses,id',
      'departure_time' => 'required|date',
      'arrival_time' => 'required|date',
      'fare' => 'required|numeric|min:0',
    ]);

    $trip = Trip::findOrFail($id);
    $trip->update($validated);

    return redirect()->route('admin.trips.index')->with('success', 'Trip updated successfully.');
  }

  // Remove the specified Trip_Route Management from the database
  public function destroy($id)
  {
    $trip = Trip::findOrFail($id);
    $trip->delete();

    return redirect()->route('admin.trips.index')->with('success', 'Trip deleted successfully.');
  }
}
