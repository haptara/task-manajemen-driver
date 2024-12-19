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
        $vehicle    = Vehicle::all();
        $driver     = Driver::all();

        $data   = [
            'title'     => 'Daftar Tasks',
            'boards'    => $boards,
            'driver'    => $driver,
            'vehicle'   => $vehicle,
        ];
        // return response()->json($boards, 200, [], JSON_PRETTY_PRINT);
        return view('tasks.index', $data);
    }
}
