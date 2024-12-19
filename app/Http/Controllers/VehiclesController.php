<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with(['driver'])->get();

        $data   = [
            'title'     => 'Daftar Vehicles',
            'vehicle'   => $vehicles,
        ];
        // return response()->json($vehicles, 200, [], JSON_PRETTY_PRINT);
        return view('vehicle.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'vehicle_number'   => 'required|unique:vehicles',
            'merk'             => 'required|string|max:255',
            'type'             => 'required|string|max:255',
        ]);

        try {
            Vehicle::create([
                'vehicle_number'   => $validated['vehicle_number'],
                'merk'             => $validated['merk'],
                'type'             => $validated['type']
            ]);

            return redirect()->route('vehicles')->with('success', 'Vehicle berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('vehicles')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
