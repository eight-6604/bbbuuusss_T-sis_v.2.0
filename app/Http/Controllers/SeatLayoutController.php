<?php

namespace App\Http\Controllers;

use App\Models\SeatLayout;
use App\Models\BusType;
use Illuminate\Http\Request;

class SeatLayoutController extends Controller
{
    public function index()
    {
        $layouts = SeatLayout::with('busType')->get();
        return view('admin.seat_layout.index', compact('layouts'));
    }

    public function create()
    {
        $busTypes = BusType::all();
        return view('admin.seat_layout.create', compact('busTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'layout_name' => 'required|string|max:100',
            'bus_type_id' => 'required|exists:bus_types,id',
            'rows'        => 'required|integer|min:1|max:20',
            'columns'     => 'required|integer|min:1|max:10',
        ]);

        $seats = [];
        $alphabet = range('A','Z');

        for($r = 0; $r < $request->rows; $r++){
            for($c = 1; $c <= $request->columns; $c++){
                $seatNumber = $alphabet[$r] . $c;
                $seats[$seatNumber] = 'available';
            }
        }


        SeatLayout::create([
            'layout_name' => $request->layout_name,
            'bus_type_id' => $request->bus_type_id,
            'rows'        => $request->rows,
            'columns'     => $request->columns,
            'seats'       => $seats, // 👈 auto-filled JSON
        ]);
        return redirect()
            ->route('admin.seat-layouts.index')
            ->with('success', 'Seat layout added successfully!');
    }

    public function edit($id)
    {
        $layout = SeatLayout::findOrFail($id);
        $busTypes = BusType::all();
        return view('admin.seat_layout.edit', compact('layout', 'busTypes'));
    }

    public function update(Request $request, $id)
    {
        $layout = SeatLayout::findOrFail($id);
        $layout->update($request->all());

        return redirect()->route('admin.seat-layouts.index')->with('success', 'Seat layout updated successfully!');
    }

    public function destroy($id)
    {
        SeatLayout::findOrFail($id)->delete();
        return redirect()->route('admin.seat-layouts.index')->with('success', 'Seat layout deleted.');
    }
}
