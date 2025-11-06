<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus; // Import Bus model
use App\Models\BusType;

class BusController extends Controller
{
    /**
     * 🚌 Display a list of all buses
     * -----------------------------------------------------
     * This method fetches all bus records from the database
     * and shows them in the "All Buses" page (index view).
     */
    public function index()
    {
        $buses = Bus::with('type')->paginate(10);
        return view('admin.bus.index', compact('buses'));
    }

    /**
     * 🆕 Show the form for adding a new bus
     * -----------------------------------------------------
     * Displays the page where admin can input bus details
     * (e.g., name, number, type, capacity, image).
     */
    public function create()
    {
        // Fetch all available bus types
        $busTypes = BusType::all();

        // Pass to the view
        return view('admin.bus.create', compact('busTypes'));
    }

    /**
     * 💾 Store a newly created bus in the database
     * -----------------------------------------------------
     * Validates user input, uploads image if available,
     * and saves the new bus record in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bus_number'  => 'required|unique:buses,bus_number',
            'bus_name'    => 'required',
            'bus_type_id' => 'required|exists:bus_types,id', // ✅ correct
            'total_seats' => 'required|integer|min:1',
            'bus_img'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('bus_img')) {
            $imagePath = $request->file('bus_img')->store('buses', 'public');
        }

        Bus::create([
            'bus_number'  => $request->bus_number,
            'bus_name'    => $request->bus_name,
            'bus_type_id' => $request->bus_type_id, // ✅ correct key
            'total_seats' => $request->total_seats,
            'bus_img'     => $imagePath,
            'status'      => 'active',
        ]);

        return redirect()->route('admin.buses.index')->with('success', 'Bus added successfully!');
    }

    /**
     * 👁️ Show the details of a single bus
     * -----------------------------------------------------
     * Displays the full information about a specific bus
     * when admin clicks the "View" button.
     */
    public function show($id)
    {
        $bus = Bus::findOrFail($id);
        return view('admin.bus.show', compact('bus'));
    }

    /**
     * ✏️ Show the edit form for a specific bus
     * -----------------------------------------------------
     * Fetches the selected bus and pre-fills the edit form.
     */
    public function edit($id)
    {
        $bus = Bus::findOrFail($id);
        $busTypes = \App\Models\BusType::all(); // ✅ fetch all types

        return view('admin.bus.edit', compact('bus', 'busTypes'));
    }

    /**
     * 🔁 Update the specified bus in the database
     * -----------------------------------------------------
     * Validates and updates existing bus details.
     */
    public function update(Request $request, $id)
    {
        $bus = Bus::findOrFail($id);

        // ✅ Validation with unique exception for current record
        $request->validate([
            'bus_number' => 'required|unique:buses,bus_number,' . $id,
            'bus_name'   => 'required|string|max:100',
            'bus_type_id'   => 'required|exists:bus_types,id',
            'total_seats'   => 'required|integer|min:1',
            'bus_img'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 🖼️ Update image if a new one is uploaded
        $imagePath = $bus->bus_imge;
        if ($request->hasFile('bus_img')) {
            $imagePath = $request->file('bus_img')->store('buses', 'public');
        }

        // 💾 Update bus record
        $bus->update([
            'bus_number' => $request->bus_number,
            'bus_name'   => $request->bus_name,
            'bus_type_id'   => $request->bus_type_id,
            'total_seats'   => $request->total_seats,
            'bus_img'  => $imagePath,
        ]);

        return redirect()->route('admin.buses.index')->with('success', 'Bus updated successfully!');
    }

    /**
     * 🗑️ Remove a bus record from the database
     * -----------------------------------------------------
     * Permanently deletes a bus when admin clicks “Delete”.
     */
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id);

        // If the bus has an image, delete it from storage
        if ($bus->bus_image && file_exists(storage_path('app/public/' . $bus->bus_img))) {
            unlink(storage_path('app/public/' . $bus->bus_img));
        }

        $bus->delete();

        return redirect()->route('admin.buses.index')->with('success', 'Bus deleted successfully.');
    }
}
