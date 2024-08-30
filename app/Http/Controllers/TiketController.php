<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiketController extends Controller
{
    public function index()
    {
        return view('tiket');
    }
}
