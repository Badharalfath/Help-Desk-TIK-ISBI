<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegInternetController extends Controller
{
    public function index()
    {
        return view('landing.reginternet');
    }
}
