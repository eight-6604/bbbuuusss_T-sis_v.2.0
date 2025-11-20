<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;

class FareController extends Controller
{
  public function index()
  {
    $trips = Trip::all();
    return view('admin.triproute_management.fares.index', compact('trips'));
  }

  public function create()
  {
    $trips = Trip::all();
    return view('admin.triproute_management.fares.create', compact('trips'));
  }

  public function store(Request $request)
  {
    $request->validate([
      'trip_id' => 'required|exists:trips,id',
      'fare'    => 'required|numeric|min:0',
    ]);

    $trip = Trip::findOrFail($request->trip_id);
    $trip->fare = $request->fare;
    $trip->save();

    return redirect()->route('fares.index')->with('success', 'Fare created successfully.');
  }

  public function edit($id)
  {
    $trip = Trip::findOrFail($id);
    return view('admin.triproute_management.fares.edit', compact('trip'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'fare' => 'required|numeric|min:0',
    ]);

    $trip = Trip::findOrFail($id);
    $trip->fare = $request->fare;
    $trip->save();

    return redirect()->route('fares.index')->with('success', 'Fare updated successfully.');
  }

  public function destroy($id)
  {
    $trip = Trip::findOrFail($id);
    $trip->fare = null;
    $trip->save();

    return redirect()->route('fares.index')->with('success', 'Fare removed successfully.');
  }
}
