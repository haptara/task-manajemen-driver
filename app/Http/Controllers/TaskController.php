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
        $boards = Board::with(['tasks.driver', 'tasks.vehicle'])->latest()->get();
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

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'id'        => 'required|exists:tasks,id',
            'status'    => 'required|in:pending,in-progress,completed',
        ]);

        $boards         = Board::where('slug', $validated['status'])->first();
        $id_boards      = $boards->id;

        $task = Task::find($validated['id']);

        if ($validated['status'] == 'in-progress' && $task->status == 'pending') {
            $task->check_in = date('Y-m-d H:i:s'); // Set check_in saat masuk in-progress
        } elseif ($validated['status'] == 'completed') {
            // Jika status berubah ke 'completed'
            if ($task->status == 'pending') {
                // Langsung dari pending ke completed
                $task->check_in = $task->check_in ?? date('Y-m-d H:i:s'); // Isi check_in jika belum terisi
            }

            $task->check_out = date('Y-m-d H:i:s'); // Set check_out saat selesai
            // Perbarui driver dan vehicle jika tugas selesai
            Driver::findOrFail($task->assigned_driver_id)->update(['status' => 'available']);
            Vehicle::findOrFail($task->vehicle_id)->update(['status' => 'available']);
        }

        // if ($validated['status'] == 'completed') {
        //     Driver::findOrFail($task->assigned_driver_id)->update(['status' => 'available']);
        //     Vehicle::findOrFail($task->vehicle_id)->update(['status' => 'Available']);

        //     $task->check_out = date('Y-m-d H:i:s');
        // }

        $task->update([
            'board_id' => $id_boards,
            'check_in' => date('Y-m-d H:i:s'),
        ]);

        $callback   = [
            'data'      => $task,
            'status'    => $validated['status'],
            'message'   => 'Status updated successfully.',
        ];

        return response()->json($callback);
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:tasks,id',
        ]);

        $task = Task::findOrFail($validated['id']);

        try {
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the task.',
            ], 500);
        }
    }
}
