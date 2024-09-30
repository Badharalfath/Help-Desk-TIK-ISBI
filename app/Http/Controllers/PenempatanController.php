<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenempatanController extends Controller
{
    public function index()
    {
        return view('management.penempatan');
    }
}
