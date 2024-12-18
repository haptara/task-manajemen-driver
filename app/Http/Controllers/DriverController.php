<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $driver = Driver::all();

        $data   = [
            'title'     => 'Daftar Driver',
            'driver'    => $driver,
        ];

        return view('driver.index', $data);
    }

    public function store(Request $request)
    {
        $validated  = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|unique:drivers|email',
            'phone' => [
                'required',
                'regex:/^(?:\+62|08)[0-9]{8,13}$/', // Format Indonesia, 8-13 digit setelah kode negara atau prefix
            ]

            // Dimulai dengan +62 atau 08. Diikuti oleh 8 hingga 13 digit angka (untuk nomor telepon Indonesia).
        ]);

        Driver::create([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('driver')->with('success', 'Driver berhasil ditambahkan!');
    }
}
