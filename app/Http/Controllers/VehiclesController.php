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
        try {
            $validated = $request->validate([
                'license_plate'    => 'required|unique:vehicles',
                'model'             => 'required|string|max:255',
            ]);
            Vehicle::create([
                'model'             => $validated['model'],
                'license_plate'     => $validated['license_plate'],
            ]);

            return redirect()->route('vehicles')->with('success', 'Vehicle berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('vehicles')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
