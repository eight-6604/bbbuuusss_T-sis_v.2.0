<?php

namespace App\Http\Controllers;

use App\Models\BusType;
use Illuminate\Http\Request;

class BusTypeController extends Controller
{
    // List all bus types
    public function index()
    {
        $busTypes = BusType::all(); // ✅ make sure variable name matches Blade
        return view('admin.bus-types.index', compact('busTypes'));
    }

    // Show form to create a new bus type
    public function create()
    {
        return view('admin.bus-types.create');
    }

    // Store new bus type
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BusType::create([
        'type_name' => $request->type_name, // 👈 use type_name
        'description' => $request->description,
    ]);

        return redirect()->route('admin.bus-types.index')
                         ->with('success', 'Bus Type added successfully.');
    }

    // Show form to edit a bus type
    public function edit(BusType $busType)
    {
        return view('admin.bus-types.edit', compact('busType'));
    }

    // Update bus type
    public function update(Request $request, BusType $busType)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $busType->update($request->only(['type_name', 'description']));

        return redirect()->route('admin.bus-types.index')
                         ->with('success', 'Bus Type updated successfully.');
    }

    // Delete bus type
    public function destroy(BusType $busType)
    {
        $busType->delete();

        return redirect()->route('admin.bus-types.index')
                         ->with('success', 'Bus Type deleted successfully.');
    }
}
