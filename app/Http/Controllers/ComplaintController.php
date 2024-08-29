<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function showForm()
    {
        return view('complaint');
    }

    public function submitForm(Request $request)
    {
        // Handle form submission logic

        return redirect()->route('complaint')->with('success', 'Your complaint has been submitted successfully!');
    }
}
