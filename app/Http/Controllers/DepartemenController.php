<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function index()
    {
        return view('management.departemen');
    }
}
