<?php

namespace App\Http\Controllers\Admin\Trip;

use App\Http\Controllers\Controller;
use App\Models\Route;  // Assuming you have a Route model
use Illuminate\Http\Request;

class RouteController extends Controller
{
  // Display a listing of the routes
  public function index()
  {
    $routes = Route::all();  // Fetch all routes from the database
    return view('admin.triproute_management.routes.index', compact('routes'));
  }

  // Show the form for creating a new route
  public function create()
  {
    return view('admin.triproute_management.routes.create');
  }

  // Store a newly created route in the database
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'start_location' => 'required|string|max:255',
      'end_location' => 'required|string|max:255',
    ]);

    Route::create($validated);

    return redirect()->route('admin.routes.index')->with('success', 'Route created successfully.');
  }

  // Show the form for editing the specified route
  public function edit($id)
  {
    $route = Route::findOrFail($id);
    return view('admin.triproute_management.routes.edit', compact('route'));
  }

  // Update the specified route in the database
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255',
      'start_location' => 'required|string|max:255',
      'end_location' => 'required|string|max:255',
    ]);

    $route = Route::findOrFail($id);
    $route->update($validated);

    return redirect()->route('admin.routes.index')->with('success', 'Route updated successfully.');
  }

  // Remove the specified route from the database
  public function destroy($id)
  {
    $route = Route::findOrFail($id);
    $route->delete();

    return redirect()->route('admin.routes.index')->with('success', 'Route deleted successfully.');
  }
}
