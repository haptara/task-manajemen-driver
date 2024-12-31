<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskdriverController extends Controller
{
    public function index(){
        $data   = [
            'title' => 'e-Task Driver'
        ];
        return view('edriver.index',$data);
    }
}
