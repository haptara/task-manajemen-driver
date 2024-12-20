<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Driver;
use App\Models\Task;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $boards     = Board::with(['tasks.driver', 'tasks.vehicle'])->get();
        $vehicle    = Vehicle::where('status', 'Available')->get();
        $driver     = Driver::where('status', 'available')->get();

        $data   = [
            'title'     => 'Daftar Tasks',
            'boards'    => $boards,
            'driver'    => $driver,
            'vehicle'   => $vehicle,
        ];
        // return response()->json($boards, 200, [], JSON_PRETTY_PRINT);
        return view('tasks.index', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:225',
            'driver'            => 'required|integer|exists:drivers,id',
            'vehicle'           => 'required|integer|exists:vehicles,id',
            'starting_from'     => 'required|string|max:225',
            'finished_in'       => 'required|string|max:225',
            'status'            => 'required|string|in:Urgent,High Priority,Normal Priority,Low Priority',
            'duration'          => 'required|string|max:225',

        ], [
            'status.in' => 'The status must be one of the following: Urgent, High Priority, Normal Priority, Low Priority.',
        ]);

        try {

            Task::create([
                'title'                 => $validated['title'],
                'description'           => $request->description,
                'board_id'              => 1, // Default
                'assigned_driver_id'    => $validated['driver'],
                'vehicle_id'            => $validated['vehicle'],
                'starting_from'         => $validated['starting_from'],
                'finished_in'           => $validated['finished_in'],
                'estimated_duration'    => $validated['duration'],
                'duration'              => $validated['duration'],
                'status'                => $validated['status'],
            ]);

            Driver::where('id', $validated['driver'])->update([
                'status' => 'in_progress',
            ]);

            Vehicle::where('id', $validated['vehicle'])->update([
                'driver_id' => $validated['driver'],
                'status'    => 'In Use',
            ]);

            return redirect()->route('tasks')->with('success', 'Task berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('tasks')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
