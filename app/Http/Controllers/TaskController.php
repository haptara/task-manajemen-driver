<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $vehicles = Tasks::with(['driver'])->get();

        $data   = [
            'title'     => 'Daftar Tasks',
            'tasks'     => $vehicles,
        ];
        // return response()->json($vehicles, 200, [], JSON_PRETTY_PRINT);
        return view('tasks.index', $data);
    }
}
