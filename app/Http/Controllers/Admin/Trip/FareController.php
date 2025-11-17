<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Fare;
use App\Models\Route;
use Illuminate\Http\Request;

class FareController extends Controller
{
  // Show all fares
  public function index()
  {
    $fares = Fare::all();
    return view('admin.triproute_management.fares.index', compact('fares'));
  }

  // Show form to create fare
  public function create()
  {
    $routes = Route::all();
    return view('admin.triproute_management.fares.create', compact('routes'));
  }

  // Store fare in database
  public function store(Request $request)
  {
    $validated = $request->validate([
      'route_id' => 'required|exists:routes,id',
      'price'    => 'required|numeric|min:0',
    ]);

    Fare::create($validated);

    return redirect()->route('admin.fares.index')
      ->with('success', 'Fare created successfully.');
  }

  // Show edit form
  public function edit($id)
  {
    $fare = Fare::findOrFail($id);
    $routes = Route::all();
    return view('admin.triproute_management.fares.edit', compact('fare', 'routes'));
  }

  // Update fare
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'route_id' => 'required|exists:routes,id',
      'price'    => 'required|numeric|min:0',
    ]);

    $fare = Fare::findOrFail($id);
    $fare->update($validated);

    return redirect()->route('admin.fares.index')
      ->with('success', 'Fare updated successfully.');
  }

  // Delete fare
  public function destroy($id)
  {
    $fare = Fare::findOrFail($id);
    $fare->delete();

    return redirect()->route('admin.fares.index')
      ->with('success', 'Fare deleted successfully.');
  }
}
