<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Task;
use App\Models\Vehicle;
use App\Models\VehicleTracking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $totalTasks         = Task::count();
        // $activeTasks        = Task::where('board_id', '2')->count();
        // $completedTasks     = Task::where('board_id', '3')->count();

        // $totalVehicles = Vehicle::count();
        // $vehiclesInUse = Vehicle::whereHas('tasks', function ($query) {
        //     $query->where('board_id', '2');
        // })->count();

        // $totalDrivers = Driver::count();
        // $availableDrivers = Driver::where('status', 'available')->count();

        // $trackingVehicles = VehicleTracking::distinct('vehicle_id')->count('vehicle_id');

        $data   = [
            'title' => 'Dashboard',
            // 'totalTasks' => $totalTasks,
            // 'activeTasks' => $activeTasks,
            // 'completedTasks' => $completedTasks,
            // 'totalVehicles' => $totalVehicles,
            // 'vehiclesInUse' => $vehiclesInUse,
            // 'trackingVehicles' => $trackingVehicles,
        ];
        return view('dashboard', $data);
    }
}
